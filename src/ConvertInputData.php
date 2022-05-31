<?php

declare(strict_types=1);

namespace App;

use Throwable;

class ConvertInputData
{
    private array $products = [];

    public function __construct(array $products, array $params)
    {
        $this->convertData($products, $params);
    }

    private function convertData(array $products, array $params = [])
    {
        foreach ($products as $index => $product) {
            $product = $this->categories($product);
            $product = $this->taxId($product);
            $product = $this->stockAlert($product);
            $product = $this->descriptionShort($product, $params);
            $product = $this->description($product, $params);
            $product = $this->photos($product, $params);
            $product = $this->metaKeywords($product);
            $product = $this->tags($product);
            $this->products[$index] = $product;
        }
    }

    private function categories(array $product)
    {
        $categoriesArray = array_reverse(explode(' > ', $product['category']));
        $categoriesArray[] = 'Wszystkie';
        $product['category'] = implode('|', $categoriesArray);
        return $product;
    }

    private function taxId(array $product): array
    {
        if ($product['tax_rate']) {
            $taxRate = $product['tax_rate'];
            switch ($taxRate) {
                case '23%':
                    $product['tax_id'] = '1';
                    break;
                case '8%':
                    $product['tax_id'] = '2';
                    break;
                case '5%':
                    $product['tax_id'] = '3';
                    break;
                case '0%':
                    $product['tax_id'] = '4';
                    break;
            }
            return $product;
        }
    }

    private function stockAlert(array $product): array
    {
        $product['low_stock_email_alert'] = $product['low_stock_level'] | "";
        return $product;
    }

    private function descriptionShort(array $product, array $params): array
    {
        $images = $params['checkDescription'];
        $allowed = $images ? '<p><a><ul><li><br><img>' : '<p><a><ul><li><br>';
        $shopAddress = $params['shopAddress'] ? strip_tags(trim($params['shopAddress'], "\/")) : '';

        $product['description_short'] = $product['description_short'] ? strip_tags($product['description_short'], $allowed) : "";
        $product['description_short'] = preg_replace("/\s{2,}/", " ", $product['description_short']);
        $product['description_short'] = str_replace(["\xc2\xa0", ' <p> </p>', '<p> </p>', '<p> </p> ', ' <p></p>', '<p></p>', '<p></p> '], '', $product['description_short']);
        $product['description_short'] = trim($product['description_short']);

        if ($images) {
            $product['description_short'] = str_replace('src="', 'src="' . $shopAddress, $product['description_short']);
        }

        return $product;
    }
    private function description(array $product, array $params): array
    {
        $images = $params['checkDescription'];
        $allowed = $images ? '<p><a><ul><li><br><img>' : '<p><a><ul><li><br>';
        $shopAddress = $params['shopAddress'] ? strip_tags(trim($params['shopAddress'], "\/")) : '';

        $product['description'] = $product['description'] ? strip_tags($product['description'], $allowed) : '';
        $product['description'] = preg_replace("/\s{2,}/", " ", $product['description']);
        $product['description'] = str_replace(["\xc2\xa0", ' <p> </p>', '<p> </p>', '<p> </p> ', ' <p></p>', '<p></p>', '<p></p> '], '', $product['description']);
        $product['description'] = trim($product['description']);

        if ($images) {
            $product['description'] = str_replace('src="', 'src="' . $shopAddress, $product['description']);
        }

        return $product;
    }

    private function photos(array $product, array $params): array
    {
        $importPhotos = $params['checkPhotos'];

        if ($importPhotos) {
            $photosUrls = [];
            for ($i = 1; $i < 8; $i++) {
                if ($product['photo_url ' . $i]) {
                    $photosUrls[] = $product['photo_url ' . $i];
                }
            }
            $product['photo_urls'] = implode('|', $photosUrls);
        }
        return $product;
    }

    private function metaKeywords(array $product): array
    {
        $product['meta_keywords'] = str_replace([', ', ','], '|', $product['meta_keywords']);
        $product['meta_keywords'] = strlen($product['meta_keywords']) > 255 ? substr($product['meta_keywords'], 0, 255) : $product['meta_keywords'];
        return $product;
    }

    private function tags(array $product): array
    {
        $product['tags'] = str_replace([', ', ','], '|', $product['tags']);
        $product['tags'] = strlen($product['tags']) > 255 ? substr($product['tags'], 0, 255) : $product['tags'];
        return $product;
    }

    public function getConvertedProducts(): array
    {
        return $this->products;
    }
}
