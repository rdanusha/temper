<?php


namespace App\Http\Controllers\Api;


use App\Repositories\DataFormatterRepositoryInterface;
use App\Repositories\DataProviderRepositoryInterface;
use App\Repositories\DataSourceRepositoryInterface;
use App\Repositories\RetentionRepositoryInterface;

class ChartApiController
{
    private $data_source;
    private $retention_repository;
    private $data_format;

    public function __construct(DataSourceRepositoryInterface $dataSource,
                                RetentionRepositoryInterface $retentionRepository,
                                DataFormatterRepositoryInterface $dataFormat)
    {
        $this->data_source = $dataSource;
        $this->retention_repository = $retentionRepository;
        $this->data_format = $dataFormat;
    }

    /**
     * Get Chart Data
     * @return mixed
     *
     */
    public function get_data()
    {
        $csv_path = storage_path('export.csv');
        $retention_data_array = $this->get_data_from_csv($csv_path);
        $chart_data_array = $this->get_chart_data_array($retention_data_array);
        $data_json = $this->format_data_json($chart_data_array);
        return $data_json;
    }


    /**
     * Get data from CSV
     * @param $csv_path
     * @return mixed
     */
    public function get_data_from_csv($csv_path)
    {
        $this->data_source->set_csv_path($csv_path);
        $retention_data_array = $this->data_source->data_output();
        return $retention_data_array;
    }

    /**
     * Get retention data for the chart
     * @param $retention_data_array
     * @return mixed
     */
    public function get_chart_data_array($retention_data_array)
    {
        $chart_data = $this->retention_repository->get_chart_data_array($retention_data_array);
        return $chart_data;
    }

    /**
     * Format data as Json
     * @param $data
     * @return mixed
     */
    public function format_data_json($data)
    {
        return $this->data_format->format($data);
    }
}
