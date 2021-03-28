<?php

namespace App\Contracts\DataSource\Output;

class JsonOutput extends BaseOutput
{
    public function output(array $response)
    {
        return response()->json($response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
