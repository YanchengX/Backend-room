<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormatController;

class HealthController extends FormatController
{
    public function __invoke()
    {
        return ['EventCode' => 1];
    }
}
