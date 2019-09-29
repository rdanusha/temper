<?php


namespace App\Repositories;


use DateTime;

class RetentionDataManager implements RetentionRepositoryInterface
{

    /**
     * @param $data_array
     * @return array
     * @throws \Exception
     */
    public function get_chart_data_array($data_array)
    {
        $weekly_retention_array = $this->weekly_retention_array($data_array);
        $data = $this->process_retention_data($weekly_retention_array);
        return $data;
    }

    /**
     * Create weekly retention data array for chart
     * @param $data_array
     * @return array
     * @throws \Exception
     */
    public function weekly_retention_array($data_array)
    {
        $weekly_retention_array = [];
        try {
            if (is_array($data_array) && !empty($data_array)) {
                foreach ($data_array AS $row) {
                    $date = new DateTime($row['created_at']);
                    $year = $date->format('Y');
                    $week = $date->format("W");
                    $week_start_date = (new DateTime())->setISODate($year, $week)->format('Y-m-d');
                    if (array_key_exists($week, $weekly_retention_array)) {
                        $weekly_retention_array[$week_start_date][] = $row['onboarding_perentage'];
                    } else {
                        $weekly_retention_array[$week_start_date][] = $row['onboarding_perentage'];
                    }
                }
            }
        } catch (\Exception $exception) {
            dd($exception);
        }

        return $weekly_retention_array;
    }

    /**
     * Calculate retention percentages
     * @param $weekly_retention_array
     * @return array
     */
    public function process_retention_data($weekly_retention_array)
    {
        $retention_data_array = [];
        try {
            if (is_array($weekly_retention_array) && !empty($weekly_retention_array)) {
                foreach ($weekly_retention_array AS $week => $data) {
                    $data[$week] = [];
                    $step_1 = 0;
                    $step_2 = 0;
                    $step_3 = 0;
                    $step_4 = 0;
                    $step_5 = 0;
                    $step_6 = 0;
                    $step_7 = 0;
                    $step_8 = 0;
                    foreach ($data AS $percentage) {
                        if ($percentage <= 100) {
                            //Create account Step - First step
                            $step_1++;
                        }
                        if ($percentage > 0 && $percentage <= 100) {
                            //Activate account Step - It means user has completed all steps under this step
                            $step_2++;
                        }
                        if ($percentage > 20 && $percentage <= 100) {
                            //Provide profile information account Step - It means user has completed all steps under this step
                            $step_3++;
                        }
                        if ($percentage > 40 && $percentage <= 100) {
                            //What jobs are you interested Step - It means user has completed all steps under this step
                            $step_4++;
                        }
                        if ($percentage > 50 && $percentage <= 100) {
                            //Do you have relevant experience in these jobs Step - It means user has completed all steps under this step
                            $step_5++;
                        }
                        if ($percentage > 70 && $percentage <= 100) {
                            //Are you a freelancer Step - It means user has completed all steps under this step
                            $step_6++;
                        }
                        if ($percentage > 90 && $percentage <= 100) {
                            //Waiting for approval Step - It means user has completed all steps under this step
                            $step_7++;
                        }
                        if ($percentage == 100) {
                            //Approval account Step - Final Step
                            $step_8++;
                        }
                    }
                    $steps_arr = [];
                    for ($x = 1; $x <= 8; $x++) {
                        $step_precentage = round((${'step_' . $x} / $step_1) * 100);
                        $steps_arr[] = $step_precentage;
                    }
                    $retention_data_array[] = ['name' => $week, 'data' => $steps_arr];
                }
            }

        } catch (\Exception $exception) {
            dd($exception);
        }
        return $retention_data_array;
    }
}
