<?php


namespace App\Services;


use App\Http\Controllers\ChartDataController;
use App\Repositories\ChartDataRepository;

/**
 * Class ChartDataService
 * @package App\Services
 */
class ChartDataService extends CSVDataService
{

    private $data_array;

    /**
     * Get processed chart data
     * @return mixed
     */
    public function get_chart_data()
    {
        $chartDataRepo = resolve(ChartDataRepository::class);
        $this->data_array = $this->get_data_from_csv();
        return $chartDataRepo->get_chart_data_array($this->data_array);
    }

}
