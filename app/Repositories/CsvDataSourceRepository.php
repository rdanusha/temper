<?php


namespace App\Repositories;


use App\Repositories\Interfaces\DataSourceRepositoryInterface;
use App\Traits\CSVHelper;

/**
 * Class CsvDataSourceRepository
 * @package App\Repositories
 */
class CsvDataSourceRepository implements DataSourceRepositoryInterface
{
    use CSVHelper;

    private $csv_path = '';
    private $delimiter = '';

    /**
     * Set CSV path and Delimiter
     * @param $csv_path
     * @param string $delimiter
     */
    public function set_csv_path($csv_path, $delimiter = ';')
    {
        $this->csv_path = $csv_path;
        $this->delimiter = $delimiter;
    }

    /**
     * Process CSV data
     * @return array|bool
     */
    public function data_output()
    {
        $csv_data_array = $this->csv_to_array($this->csv_path, $this->delimiter);
        return $csv_data_array;
    }


}
