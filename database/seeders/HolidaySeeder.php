<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $holidays =[
      [
        'name'=>'Día 1',
        'holiday_day'=>'2023-07-07 10:00',
        'holiday_type_id'=>1,
        'is_repeat'=>0,
        'user_id'=>1,
        'status'=>1,
      ],
      [
        'name'=>'Día 2',
        'holiday_day'=>'2023-08-07 10:00',
        'holiday_type_id'=>1,
        'is_repeat'=>0,
        'user_id'=>1,
        'status'=>1,
      ],
      [
        'name'=>'Día 1',
        'holiday_day'=>'2023-09-07 10:00',
        'holiday_type_id'=>1,
        'is_repeat'=>0,
        'user_id'=>1,
        'status'=>1,
      ],
    ];
    foreach($holidays as $holiday){
        Holiday::create($holiday);
    }
    }
}
