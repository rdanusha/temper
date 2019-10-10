<?php


namespace App\Http\Controllers;


/**
 * Class ChartController
 * @package App\Http\Controllers
 */
class ChartController
{
    /**
     * Load Chart View
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('chart');
    }
}
