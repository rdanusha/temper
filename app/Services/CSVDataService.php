<?php


namespace App\Services;


use App\Repositories\CsvDataSourceRepository;

/**
 * Class CSVDataService
 * @package App\Services
 */
class CSVDataService extends DataFormatService
{

    private $csv_path;
    private $data_array;

    /**
     * Get data from csv file
     */
    public function get_data_from_csv()
    {
        $csvDataSourceRepo = resolve(CsvDataSourceRepository::class);
        $this->csv_path = storage_path('export.csv');
        $csvDataSourceRepo->set_csv_path($this->csv_path);
        $this->data_array = $csvDataSourceRepo->data_output();
        return $this->data_array;
    }
}
