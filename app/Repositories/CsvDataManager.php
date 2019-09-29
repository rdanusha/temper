<?php


namespace App\Repositories;


class CsvDataManager implements DataSourceRepositoryInterface
{

    public $csv_path = '';
    public $delimiter = '';

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

    /**
     * Get Data array from CSV
     * @link http://gist.github.com/385876
     * @param string $filename
     * @param string $delimiter
     * @return array|bool
     */
    public function csv_to_array($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}
