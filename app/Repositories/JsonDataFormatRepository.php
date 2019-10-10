<?php


namespace App\Repositories;


use App\Repositories\Interfaces\DataFormatterRepositoryInterface;

/**
 * Class JsonDataFormatRepository
 * @package App\Repositories
 */
class JsonDataFormatRepository implements DataFormatterRepositoryInterface
{
    /**
     * Convert data array to json format
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function format($data)
    {
        return response()->json($data);
    }
}
