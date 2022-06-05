<?php

declare(strict_types=1);

namespace App;

use Throwable;

class Converter
{
    private array $products = [];


    public function getConvertedProducts(): array
    {
        return $this->products;
    }

    public function __construct(array $products, array $params)
    {
        $this->convertData($products, $params);
    }

    private function convertData(array $products, array $params = []): void
    {
        try {
            foreach ($products as $index => $product) {
                $product = $this->categories($product);
                $product = $this->taxId($product);
                $product = $this->stockAlert($product);
                $product = $this->descriptionShort($product, $params);
                $product = $this->description($product, $params);
                $product = $this->photos($product, $params);
                $product = $this->metaKeywords($product);
                $product = $this->tags($product);
                $product = $this->sort($product);
                $this->products[$index] = $product;
            }
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter convertData error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversion");
            exit;
        }
    }

    private function categories(array $product): array
    {
        try {
            $categoriesArray = array_reverse(explode(' > ', $product['category']));
            $categoriesArray[] = 'Wszystkie';
            $product['category'] = implode('|', $categoriesArray);
            return $product;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter categories error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversionCategories");
            exit;
        }
    }

    private function taxId(array $product): array
    {
        try {
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
                unset($product['tax_rate']);
                return $product;
            }
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter taxId error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversionTaxId");
            exit;
        }
    }

    private function stockAlert(array $product): array
    {
        try {
            $product['low_stock_email_alert'] = $product['low_stock_level'] | "";
            return $product;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter stockAlert error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversionStockAlert");
            exit;
        }
    }

    private function descriptionShort(array $product, array $params): array
    {
        try {
            $images = isset($params['copy-pictures']) ? true : false;
            $shopAddress = isset($params['shop-address']) ? strip_tags(trim($params['shop-address'], "\/")) : '';
            $styles = isset($params['copy-styles']) ? true : false;
            $bold = isset($params['copy-bold']) ? true : false;

            $htmlTagsAllowed = '<p><a><ul><ol><li><table><tr><th><td><thead><tbody><tfoot><br>';
            if ($images) {
                $htmlTagsAllowed .= '<img>';
            };
            if ($styles) {
                $htmlTagsAllowed .= '<span><h1><h2><h3><h4><h5><h6><div><blockquote><code><mark><q><sub><sup><hr><abbr><cite><code><del><dfn><s><samp><figure><figcaption><small><ins><kbd><dl><dt><dd><pre><u><em><i><b><strong>';
            };
            if ($bold && !$styles) {
                $htmlTagsAllowed .= '<b><strong>';
            };

            if (!$styles) {
                $product['description_short'] = str_replace(['<h1', '<h2', '<h3', '<h4', '<h5', '<h6'], '<p', $product['description_short']);
                $product['description_short'] = str_replace(['</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>'], '</p>', $product['description_short']);
            }

            $product['description_short'] = $product['description_short'] ? strip_tags($product['description_short'], $htmlTagsAllowed) : "";
            $product['description_short'] = str_replace("\xc2\xa0", ' ', $product['description_short']);
            $product['description_short'] = preg_replace("/\s{2,}/", ' ', $product['description_short']);

            if (!$styles) {
                $product['description_short'] = preg_replace('/\s{1,}style=".*?"\s*/i', "", $product['description_short']);
            }

            $product['description_short'] = str_replace([' <p> </p>', '<p> </p>', '<p> </p> ', ' <p></p>', '<p></p>', '<p></p> '], '', $product['description_short']);
            $product['description_short'] = trim($product['description_short']);

            if ($images) {
                $product['description_short'] = str_replace('src="', 'src="' . $shopAddress, $product['description_short']);
            }

            return $product;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter descriptionShort error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversionDescShort");
            exit;
        }
    }
    private function description(array $product, array $params): array
    {
        try {
            $images = isset($params['copy-pictures']) ? true : false;
            $shopAddress = isset($params['shop-address']) ? strip_tags(trim($params['shop-address'], "\/")) : '';
            $styles = isset($params['copy-styles']) ? true : false;
            $bold = isset($params['copy-bold']) ? true : false;

            $htmlTagsAllowed = '<p><a><ul><ol><li><table><tr><th><td><thead><tbody><tfoot><br>';
            if ($images) {
                $htmlTagsAllowed .= '<img>';
            };
            if ($styles) {
                $htmlTagsAllowed .= '<span><h1><h2><h3><h4><h5><h6><div><blockquote><code><mark><q><sub><sup><hr><abbr><cite><code><del><dfn><s><samp><figure><figcaption><small><ins><kbd><dl><dt><dd><pre><u><em><i><b><strong>';
            };
            if ($bold && !$styles) {
                $htmlTagsAllowed .= '<b><strong>';
            };

            if (!$styles) {
                $product['description'] = str_replace(['<h1', '<h2', '<h3', '<h4', '<h5', '<h6'], '<p', $product['description_short']);
                $product['description'] = str_replace(['</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>'], '</p>', $product['description_short']);
            }

            $product['description'] = $product['description'] ? strip_tags($product['description'], $htmlTagsAllowed) : '';
            $product['description'] = str_replace("\xc2\xa0", ' ', $product['description']);
            $product['description'] = preg_replace("/\s{2,}/", ' ', $product['description']);

            if (!$styles) {
                $product['description'] = preg_replace('/\s{1,}style=".*?"\s*/i', "", $product['description']);
            }

            $product['description'] = str_replace([' <p> </p>', '<p> </p>', '<p> </p> ', ' <p></p>', '<p></p>', '<p></p> '], '', $product['description']);
            $product['description'] = trim($product['description']);

            if ($images) {
                $product['description'] = str_replace('src="', 'src="' . $shopAddress, $product['description']);
            }

            return $product;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter description error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversionDescription");
            exit;
        }
    }

    private function photos(array $product, array $params): array
    {
        try {
            $importPhotos = isset($params['copy-photos']) ? true : false;
            $product['photo_urls'] = '';
            if ($importPhotos) {
                $photosUrls = [];
                for ($i = 1; $i < 8; $i++) {
                    if ($product['photo_url ' . $i]) {
                        $photosUrls[] = $product['photo_url ' . $i];
                    }
                    unset($product['photo_url ' . $i]);
                }
                $product['photo_urls'] = implode('|', $photosUrls);
            } else {
                for ($i = 1; $i < 8; $i++) {
                    unset($product['photo_url ' . $i]);
                }
            }
            return $product;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter photos error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversionPhotos");
            exit;
        }
    }

    private function metaKeywords(array $product): array
    {
        try {
            $product['meta_keywords'] = str_replace([', ', ','], '|', $product['meta_keywords']);
            $product['meta_keywords'] = strlen($product['meta_keywords']) > 255 ? substr($product['meta_keywords'], 0, 255) : $product['meta_keywords'];
            return $product;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter metaKeywords error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversionMetaKeywords");
            exit;
        }
    }

    private function tags(array $product): array
    {
        try {
            $product['tags'] = str_replace([', ', ','], '|', $product['tags']);
            $product['tags'] = strlen($product['tags']) > 255 ? substr($product['tags'], 0, 255) : $product['tags'];
            return $product;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter tags error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversionTags");
            exit;
        }
    }

    private function sort(array $product): array
    {
        try {
            $sortedProduct = [];
            $sortedProduct['product_reference'] = $product['product_reference'];
            $sortedProduct['active'] = $product['active'];
            $sortedProduct['category'] = $product['category'];
            $sortedProduct['name'] = $product['name'];
            $sortedProduct['price_tax_included'] = $product['price_tax_included'];
            $sortedProduct['tax_id'] = $product['tax_id'];
            $sortedProduct['unit'] = $product['unit'];
            $sortedProduct['brand'] = $product['brand'];
            $sortedProduct['weight'] = $product['weight'];
            $sortedProduct['description_short'] = $product['description_short'];
            $sortedProduct['description'] = $product['description'];
            $sortedProduct['stock'] = $product['stock'];
            $sortedProduct['low_stock_level'] = $product['low_stock_level'];
            $sortedProduct['low_stock_email_alert'] = $product['low_stock_email_alert'];
            $sortedProduct['delivery_time'] = $product['delivery_time'];
            $sortedProduct['photo_urls'] = $product['photo_urls'];
            $sortedProduct['meta_description'] = $product['meta_description'];
            $sortedProduct['meta_title'] = $product['meta_title'];
            $sortedProduct['meta_keywords'] = $product['meta_keywords'];
            $sortedProduct['tags'] = $product['tags'];
            $sortedProduct['ean13'] = $product['ean13'];
            return $sortedProduct;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Converter sort error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=conversionSort");
            exit;
        }
    }
}
