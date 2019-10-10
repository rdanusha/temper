<?php


namespace App\Http\Controllers\Api;


use App\Services\ChartDataService;

/**
 * Class ChartApiController
 * @package App\Http\Controllers\Api
 */
class ChartApiController extends ChartDataService
{

    /**
     * Get Chart data
     * @return mixed
     */
    public function get_data()
    {
        return $this->get_chart_data();
    }

}

