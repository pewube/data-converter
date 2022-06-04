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
