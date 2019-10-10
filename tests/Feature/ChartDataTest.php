<?php

namespace Tests\Feature;

use App\Repositories\ChartDataRepository;
use App\Repositories\CsvDataSourceRepository;
use Tests\TestCase;

class ChartDataTest extends TestCase
{
    private function set_csv_path()
    {
        $csvDataSourceRepository = new CsvDataSourceRepository();
        $csv_path = storage_path('export.csv');
        $csvDataSourceRepository->set_csv_path($csv_path);
        return $csvDataSourceRepository;
    }

    public function test_display_chart_landing_page()
    {
        $response = $this->get('/')->assertStatus(200);
    }

    public function test_get_chart_data_as_json_format()
    {
        $response = $this->json('GET', '/api/get-chart-data', []);

        $response->assertStatus(200)
            ->assertJsonFragment([['name' => '2016-08-01', 'data' => [19, 53, 53, 65, 66, 100, 100, 100]]]);
    }

    public function test_get_csv_data_to_array()
    {
        $response = $this->set_csv_path()->data_output();
        $this->assertIsArray($response);
    }


    public function test_process_chart_data()
    {
        $data = $this->set_csv_path()->data_output();
        $chartDataRepository = new ChartDataRepository();
        $this->assertIsArray($chartDataRepository->get_chart_data_array($data));
    }
}
