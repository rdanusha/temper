<?php

namespace Tests\Feature;

use Tests\TestCase;

class ChartDataTest extends TestCase
{

    public function test_display_chart_landing_page()
    {
        $response = $this->get('/')->assertStatus(200);
    }

    public function test_get_chart_data_as_json_format()
    {
        $response = $this->json('GET', '/api/get-chart-data', []);

        $response->assertStatus(200)
            ->assertJsonFragment([['name' => '2016-08-01','data'=> [19,53,53,65,66,100,100,100]]]);
    }
}
