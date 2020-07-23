<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Persons;

class testController extends Controller
{
    public function persons()
    {
        $persons = Persons::limit(10)->get();
        return json_encode($persons, true);
    }
}