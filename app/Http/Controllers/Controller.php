<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index()
    {
        $path = storage_path('export.csv');
        $dataArray = $this->csvToArray($path, ';');
        $weekArray = $this->createWeekWiseArray($dataArray);
        $x = $this->retentionPrecentage($weekArray);

        dd($x);

        return response()->json($x);
    }

    /**
     * @param string $filename
     * @param string $delimiter
     * @return array|bool
     * @link http://gist.github.com/385876
     */
    function csvToArray($filename = '', $delimiter = ',')
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

    public function createWeekWiseArray(array $data)
    {
        $weekArray = [];
        foreach ($data AS $row) {
            $date = new DateTime($row['created_at']);
            $year = $date->format('Y');
            $week = $date->format("W");
            $week_start_date = (new DateTime())->setISODate($year, $week)->format('Y-m-d');
            if (array_key_exists($week, $weekArray)) {
                $weekArray[$week_start_date][] = $row['onboarding_perentage'];
            } else {
                $weekArray[$week_start_date][] = $row['onboarding_perentage'];
            }
        }
        return $weekArray;
    }

    public function retentionPrecentage($weekArray)
    {
        $precentagesArr = [];
        foreach ($weekArray AS $week => $data) {
            $data[$week] = [];
            $step_1 = 0;
            $step_2 = 0;
            $step_3 = 0;
            $step_4 = 0;
            $step_5 = 0;
            $step_6 = 0;
            $step_7 = 0;
            $step_8 = 0;
            foreach ($data AS $perentage) {
                if ($perentage <= 100) {
                    //Create account Step - No other steps under this step
                    $step_1++;
                }
                if ($perentage > 0 && $perentage <= 100) {
                    //Activate account Step - It means user has completed all steps under this step
                    $step_2++;
                }
                if ($perentage > 20 && $perentage <= 100) {
                    //Provide profile information account Step - It means user has completed all steps under this step
                    $step_3++;
                }
                if ($perentage > 40 && $perentage <= 100) {
                    //What jobs are you interested Step - It means user has completed all steps under this step
                    $step_4++;
                }
                if ($perentage > 50 && $perentage <= 100) {
                    //Do you have relevant experience in these jobs Step - It means user has completed all steps under this step
                    $step_5++;
                }
                if ($perentage > 70 && $perentage <= 100) {
                    //Are you a freelancer Step - It means user has completed all steps under this step
                    $step_6++;
                }
                if ($perentage > 90 && $perentage <= 100) {
                    //Waiting for approval Step - It means user has completed all steps under this step
                    $step_7++;
                }
                if ($perentage == 100) {
                    //Approval account Step - It means user has completed all steps under this step
                    $step_8++;
                }
            }
            $steps_arr = [];
            for ($x = 1; $x <= 8; $x++) {
                $step_precentage = round((${'step_' . $x} / $step_1) * 100);
                $steps_arr[] = $step_precentage;
            }
            $precentagesArr[] = ['name' => $week, 'data' => $steps_arr];
        }
        return $precentagesArr;
    }

    public function loadData()
    {

    }

}
