<?php

namespace App\Services;


use App\Dto\CoordinatesDTO;

class CsvServiceImport
{
    /**
     * @var string
     */
    private $path;

    /**
     * CsvServiceImport constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param string $fileName
     * @return \Illuminate\Support\Collection
     */
    public function parseCsv(string $fileName) {

        $rows = collect();

        $path = $this->path. '/' .$fileName;

        if (($h = fopen("{$path}", "r")) !== FALSE)
        {
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE)
            {
                if($this->isValidCoordinates($data)) {
                    $rows->push($this->makeCoordinatesDto($data));
                }
            }
            fclose($h);
        }
        return $rows;
    }

    /**
     * @param array $arr
     * @return CoordinatesDTO
     */
    private function makeCoordinatesDto(array $arr) {
        return new CoordinatesDTO($arr[0], $arr[1]);
    }

    /**
     * @param array $arr
     * @return bool
     */
    private function isValidCoordinates(array $arr) {
        return isset($arr[0]) && isset($arr[1]);
    }
}
