<?php

declare(strict_types=1);

namespace App;

use Throwable;

class Database
{
    private array $headers = [];
    private array $products = [];
    private int $maxCsvLineLength = 0;

    public function getRawData(): array
    {
        return $this->products;
    }

    public function __construct(string $inputFileName, int $maxCsvLineLength = 30000)
    {
        $this->maxCsvLineLength = $maxCsvLineLength;
        $this->createData($inputFileName);
    }

    private function createData(string $inputFileName): void
    {
        try {
            $handle = fopen($inputFileName, 'r');

            if ($handle) {
                $this->headers = $this->importHeaders($handle);
                $this->products = $this->importProducts($handle);

                foreach ($this->products as $index => $product) {
                    $this->testProduct($product, $this->headers);
                    $this->products[$index] = $this->createAssociativeArray($product, $this->headers);
                }
            }

            fclose($handle);
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Database createData error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=inputData");
            exit;
        }
    }

    private function importHeaders($handle): array
    {
        try {
            return fgetcsv($handle, $this->maxCsvLineLength, ';');
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Database importHeaders error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=inputHeaders");
            exit;
        }
    }

    private function importProducts($handle): array
    {
        try {
            $products = [];

            while (!feof($handle)) {
                $products[] = fgetcsv($handle, $this->maxCsvLineLength, ';');
            }

            unset($products[count($products) - 1]);
            return $products;
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Database importProducts error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=inputProducts");
            exit;
        }
    }

    private function testProduct(array $product, array $headers): void
    {
        $headersLength = count($headers);
        $productLength = count($product);

        if ($headersLength != $productLength) {
            error_log(date("Y-m-d H:i:s") . ' Database testProduct failed. Check if the number of characters in any CSV line is not greater than ' . $this->maxCsvLineLength . " or CSV delimiter is not different than ';';\n", 3, 'src/logs/errors.log');
            header("Location: \?error=testCsvFailed");
            exit;
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
            error_log(date("Y-m-d H:i:s") . ' Database createAssociativeArray error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=inputData");
            exit;
        }
    }
}
