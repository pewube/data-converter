<?php

declare(strict_types=1);

namespace App;

class View
{
    public function render(string $page, array $params): void
    {
        require_once('./templates/layout.php');
    }

    public function getConversionParams(): array
    {
        $conversionParams = [];

        $conversionParams['checkPhotos'] = isset($_POST['check-photos']) ? true : false;
        $conversionParams['checkDescription'] = isset($_POST['check-description']) ? true : false;

        $conversionParams['shopAddress'] = isset($_POST['shop-address']) ? $_POST['shop-address'] : '';

        return $conversionParams;
    }
}
