<?php


namespace App\Repositories;


class JsonDataFormatter implements DataFormatterRepositoryInterface
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
