<?php

declare(strict_types=1);

namespace App;

class Controller
{
    private static array $config = [];

    private const DEFAULT_ACTION = 'home';
    private Request $request;
    private View $view;
    private Database $database;
    private Converter $converter;
    private Creator $creator;

    public static function initConfiguration(array $config): void
    {
        self::$config = $config;
    }

    public function run()
    {
        $captchaSecretKey = self::$config['captchaSecretKey'] ?? '';
        $capchaResponse = $this->request->postParam('g-recaptcha-response') ?? '';

        switch (Validator::validate($captchaSecretKey, $capchaResponse)) {
            case 1:
                $this->initConversion();
                $fileName = $this->creator->getFileName();
                if (isset($fileName)) {
                    header('Location: /?download=' . $fileName);
                }
                break;
            case -1:
                header('Location: /?error=captchaFailed');
                exit;
                break;
            case 0:
                if ($this->request->filesParam('shoper-csv')) {
                    header('Location: /?error=noCaptcha');
                    exit;
                }
                break;
        }

        switch ($this->getAction()) {
            case 'help':
                $page = 'help';
                $viewParams = [];
                break;
            default:
                $page = 'home';
                $viewParams = [
                    'captchaSiteKey' => self::$config['captchaSiteKey'],
                    'filePath' => self::$config['downloadDir'],
                    'download' => $this->request->getParam('download'),
                    'error' => $this->request->getParam('error'),
                    'copy-photos' => $this->request->getParam('copy-photos'),
                    'copy-pictures' => $this->request->getParam('copy-pictures'),
                    'copy-styles' => $this->request->getParam('copy-styles'),
                    'copy-bold' => $this->request->getParam('copy-bold'),
                    'deactivate-product' => $this->request->getParam('deactivate-product'),
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

    private function initConversion(): void
    {

        $csv_mimetypes = [
            'application/vnd.ms-excel',
            'text/plain',
            'text/csv',
            'text/tsv'
        ];

        if (!empty($this->request->postParam('submit'))) {

            switch ($this->request->filesParam('shoper-csv')['error']) {
                case 0:
                    if ((in_array($this->request->filesParam('shoper-csv')['type'], $csv_mimetypes))) {
                        if (
                            (int)$this->request->filesParam('shoper-csv')['size'] < self::$config['maxUploadFileSize']

                        ) {
                            $this->database = new Database($this->getInputFileName(), self::$config['maxCsvLineLength']);

                            $this->converter = new Converter($this->database->getRawData(), $this->request->postParams());

                            $this->creator = new Creator($this->converter->getConvertedProducts(), self::$config['downloadDir']);
                        } else {
                            error_log(date("Y-m-d H:i:s") . ' Controller init conversion upload error: uploaded file exceeds upload max file size in config - file size: ' . $this->request->filesParam('shoper-csv')['size'] . " bytes;\n", 3, 'src/logs/errors.log');
                            header("Location: \?error=fileSize");
                            exit;
                        };
                    } else {
                        error_log(date("Y-m-d H:i:s") . ' Controller init conversion upload error: uploaded file is not CSV type' . ";\n", 3, 'src/logs/errors.log');
                        header("Location: \?error=fileType");
                        exit;
                    }
                    break;
                case 4:
                    error_log(date("Y-m-d H:i:s") . ' Controller init conversion file upload error no. 4: no file was uploaded' . ";\n", 3, 'src/logs/errors.log');
                    header("Location: \?error=noFileUploaded");
                    exit;
                    break;
                default:
                    error_log(date("Y-m-d H:i:s") . ' Controller init conversion upload error no. ' .  $this->request->filesParam('shoper-csv')['error'] . ";\n", 3, 'src/logs/errors.log');
                    header("Location: \?error=uploadFailed");
                    exit;
                    break;
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
