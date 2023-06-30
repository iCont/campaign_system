<?php

namespace App\Http\Controllers;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index(){
        $all_holidays= Holiday::all();
        $holidays = [];

        foreach($all_holidays  as $holiday){
            $holidays[]=[
                'title'=>$holiday->name,
                'start'=>$holiday->holiday_day,
                'end'=>$holiday->holiday_day
            ];
        }
        return view('holidays.index',compact('holidays'));
    }
}
