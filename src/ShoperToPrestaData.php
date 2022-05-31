<?php

declare(strict_types=1);

namespace App;

require_once('ConvertInputData.php');

use App\ConvertInputData;
use Throwable;
use Exception;

class ShoperToPrestaData
{
    private array $headers = [];
    private array $products = [];
    private string $downloadDir = 'public/downloads/'; // config
    private string $fileLink = '';
    private int $maxCsvLineLength = 50000; //config

    public function getFileLink(): string
    {
        return $this->fileLink;
    }

    public function __construct(string $inputFileName, array $conversionParams)
    {
        $this->csvToArray($inputFileName);
        $this->products = (new ConvertInputData($this->products, $conversionParams))->getConvertedProducts();
        $this->deleteFiles();
        $this->saveArrayAsCsv($this->products);
    }

    private function csvToArray($inputFileName)
    {
        try {
            $handle = fopen($inputFileName, 'r');

            if ($handle) {
                $this->headers = $this->getHeaders($handle);
                $this->products = $this->getProducts($handle);

                foreach ($this->products as $index => $product) {
                    $this->testProduct($product, $this->headers);
                    $this->products[$index] = $this->createAssociativeArray($product, $this->headers);
                }
            }

            fclose($handle);
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Cannot create final associative array: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            exit('Błąd: brak prawidłowego pliku CSV');
        }
    }

    private function getHeaders($handle): array
    {
        try {
            return fgetcsv($handle, $this->maxCsvLineLength, ';');
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' getHeaders error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            exit('Błąd: brak prawidłowego pliku CSV');
        }
    }

    private function getProducts($handle): array
    {
        try {
            $products = [];

            while (!feof($handle)) {
                $products[] = fgetcsv($handle, $this->maxCsvLineLength, ';');
            }

            unset($products[count($products) - 1]);
            return $products;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' getProducts error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            exit('Błąd: brak prawidłowego pliku CSV');
        }
    }

    private function testProduct(array $product, array $headers): void
    {
        $headersLength = count($headers);
        $productLength = count($product);

        if ($headersLength != $productLength) {
            throw new Exception('testProduct failed. Check if the number of characters in any CSV line is not greater than ' . $this->maxCsvLineLength);
            exit();
        }
    }

    private function createAssociativeArray(array $arr, array $headers): array
    {
        try {
            $associative = [];
            $arrLength = count($arr);

            for ($i = 0; $i < $arrLength; $i++) {
                $associative[$headers[$i]] = $arr[$i];
            }

            return $associative;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' createAssociativeArray error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            exit('Błąd: brak prawidłowego pliku CSV');
        }
    }

    private function deleteFiles(): void
    {
        array_map('unlink', glob($this->downloadDir . '*.csv'));
    }

    private function saveArrayAsCsv(array $products)
    {
        try {
            $fileId = uniqid();
            $fileName = 'presta-products-' . $fileId;
            $filePath = $this->downloadDir . $fileName . '.csv';
            $readyFile = fopen($filePath, 'w');
            $this->fileLink = $filePath;

            fputcsv($readyFile, array_keys($products[0]), ";");
            foreach ($products as $line) {
                fputcsv($readyFile, $line, ';');
            }
            fclose($readyFile);
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' saveArrayAsCsv error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            exit('Błąd: problem z utworzeniem pliku CSV');
        }
    }
}
