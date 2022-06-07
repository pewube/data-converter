<?php

declare(strict_types=1);

namespace App;

class View
{
    private string $copyPhotos = '';
    private string $copyPictures = '';
    private string $copyStyles = '';
    private string $copyBold = '';
    private array $errorMessages = [];
    private string $helpIcon = '<svg class="info-icons" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/></svg>';

    public function render(string $page, array $params): void
    {
        $this->isCheckboxChecked($params);
        $this->errorMessages = require_once('./config/errorsMsg.php');
        require_once('./templates/layout.php');
    }

    private function isCheckboxChecked($params): void
    {
        $this->copyPhotos = isset($params['copy-photos']) ? 'checked' : '';
        $this->copyPictures = isset($params['copy-pictures']) ? 'checked' : '';
        $this->copyStyles = isset($params['copy-styles']) ? 'checked' : '';
        $this->copyBold = isset($params['copy-bold']) ? 'checked' : '';
    }
}
