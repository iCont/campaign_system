<?php

namespace App\Http\Controllers;
use App\Models\Holiday;
use App\Models\HolidayType;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index(){
        $holidaysType = HolidayType::all();
        $all_holidays= Holiday::all();
        $holidays = [];

        foreach($all_holidays  as $holiday){
            $holidays[]=[
                'title'=>$holiday->name,
                'start'=>$holiday->holiday_day,
                'end'=>$holiday->holiday_day,
            ];
        }
        return view('holidays.index',compact('holidays','holidaysType'));
    }

    public function store(Request $request){
        // dd($request);
        if($request->is_repeat=='on'){
            $is_repeat=1;
        }else{
            $is_repeat=0;
        }
        Holiday::create([
            'name'=>$request->campaing_name,
            'holiday_day'=>$request->holiday_day.' '.'10:00:00',
            'holiday_type_id'=>$request->holiday_type,
            'is_repeat'=>$is_repeat,
            'user_id'=>1,
            'status'=>1
        ]);
        return back()->with('success', 'ok');
    }
}
