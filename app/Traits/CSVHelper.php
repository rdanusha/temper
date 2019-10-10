<?php

namespace App\Traits;

/**
 * Trait CSVHelper
 * @package App\Traits
 */
trait CSVHelper
{
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
