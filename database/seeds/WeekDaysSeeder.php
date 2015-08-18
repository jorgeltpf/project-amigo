<?php

use Illuminate\Database\Seeder;
use App\Models\WeekDay;

class WeekDaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     //    $week = \App\Models\WeekDay::create([
     //    	'name' => 'Domingo'
    	// ]);
        DB::table('week_days')->delete();

        $weekday = new Weekday();
        $weekday->name = 'Domingo';
        $weekday->save();

        $weekday = new Weekday();
        $weekday->name = 'Segunda';
        $weekday->save();

        $weekday = new Weekday();
        $weekday->name = 'Terça';
        $weekday->save();

		$weekday = new Weekday();
        $weekday->name = 'Quarta';
        $weekday->save();

        $weekday = new Weekday();
        $weekday->name = 'Quinta';
        $weekday->save();

        $weekday = new Weekday();
        $weekday->name = 'Sexta';
        $weekday->save();

		$weekday = new Weekday();
        $weekday->name = 'Sábado';
        $weekday->save();
    }
}
