<?php

declare(strict_types=1);

namespace App;

use Throwable;

class Creator
{
    private string $fileName = '';

    public function getFileName(): ?string
    {
        return $this->fileName ?? null;
    }

    public function __construct(array $products, string $targetDir)
    {
        $this->deleteOldFiles($targetDir);
        $this->saveCsv($products, $targetDir);
    }

    private function deleteOldFiles(string $targetDir): void
    {
        array_map('unlink', glob($targetDir . '*.csv'));
    }

    private function saveCsv(array $products, string $targetDir): void
    {
        try {
            $fileName = 'presta-products-' . date("ymdHis");
            $filePath = $targetDir . $fileName . '.csv';
            $readyFile = fopen($filePath, 'w');
            $this->fileName = $fileName;

            fputcsv($readyFile, array_keys($products[0]), ";");
            foreach ($products as $line) {
                fputcsv($readyFile, $line, ';');
            }
            fclose($readyFile);
        } catch (Throwable $e) {
            error_log(date("Y-m-d H:i:s") . ' Creator saveArrayAsCsv error: ' . $e->getMessage() . ";\n", 3, 'src/logs/errors.log');
            header("Location: \?error=saveData");
            exit;
        }
    }
}
