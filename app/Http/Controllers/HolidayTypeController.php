<?php

namespace App\Http\Controllers;

use App\Models\HolidayType;
use Illuminate\Http\Request;

class HolidayTypeController extends Controller
{
    public function index(){

        return view('holiday_type.index');
    }
}
