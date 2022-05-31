<?php

declare(strict_types=1);

namespace App;


class Database
{
    private array $headers = [];
    private array $products = [];

    public function __construct()
    {
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
}
