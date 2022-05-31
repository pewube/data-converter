<?php

declare(strict_types=1);

namespace App;

require_once('View.php');
require_once('ShoperToPrestaData.php');
require_once('Request.php');

class Controller
{
    private static array $configuration = [];

    private const DEFAULT_ACTION = 'home';
    private Request $request;
    private View $view;
    private string $fileLink = '';

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }

    public function run()
    {
        $this->reCaptcha();
        // $this->initConversion();


        switch ($this->getAction()) {
            case 'download':
                $page = 'download';
                break;
            default:
                $page = 'home';
                $viewParams = [
                    'fileLink' => $this->fileLink,
                    'captchaSiteKey' => self::$configuration['captchaSiteKey'],
                    'download' => $this->request->getParam('download')
                ];
                break;
        }

        $this->view->render($page, $viewParams);
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->view = new View();
    }

    private function reCaptcha()
    {
        $data = $this->request->postParam('g-recaptcha-response');

        if (isset($data) && !empty($data)) {
            $googleUrl = 'https://www.google.com/recaptcha/api/siteverify?secret=' . self::$configuration['captchaSecretKey'] . '&response=' . $data;
            $replaceResponse = file_get_contents($googleUrl);
            $responseData = json_decode($replaceResponse, true);

            if ($responseData['success'] === true) {

                $this->initConversion();
            } else {
                // komunikat !
                echo 'Weryfikacja CAPTCHA nie powiodła się, spróbuj ponownie.';
            }
        } else {
            // komunikat ! i ramka wokół CAPTCHA
            echo 'Potwierdź, że nie jesteś robotem';
        }
    }

    private function initConversion(): void
    {

        $csv_mimetypes = [
            'application/vnd.ms-excel',
            'text/plain',
            'text/csv',
            'text/tsv'
        ];

        if (!empty($this->request->postParam('submit'))) {

            if ($this->request->filesParam('shoper-csv')['size'] && (int)$this->request->filesParam('shoper-csv')['size'] < 10485761) {

                if (
                    (in_array($this->request->filesParam('shoper-csv')['type'], $csv_mimetypes)) &&
                    ($this->request->filesParam('shoper-csv')['error'] == UPLOAD_ERR_OK)
                ) {
                    $prestaData = new ShoperToPrestaData($this->getInputFileName(), $this->view->getConversionParams());
                    $this->fileLink = $prestaData->getFileLink();
                } else {
                    // komunikat !
                    echo '<br/>Aplikacja napotkała błąd podczas wczytywania pliku. Sprawdź czy wybrałeś do wczytania prawidłowy plik CSV.<br/>';
                };
            } else {
                // komunikat !
                echo '<br/>Wczytywany plik CSV może mieć rozmiar maks. 10MB. Jeżeli potrzebujesz skonwertować więcej danych skontaktuj się z administratorem<br/>';
            }
        }
    }


    private function getAction(): string
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }

    private function getInputFileName(): string
    {
        return $this->request->filesParam('shoper-csv')['tmp_name'];
    }
}
