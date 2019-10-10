<?php


namespace App\Services;


use App\Repositories\JsonDataFormatRepository;

/**
 * Class DataFormatService
 * @package App\Services
 */
class DataFormatService
{

    /**
     * Format data array to Json Format
     * @param $data
     * @return mixed
     */
    public function format_data_json($data)
    {
        $jsonDataFormatRepo = resolve(JsonDataFormatRepository::class);
        return $jsonDataFormatRepo->format($data);
    }
}
