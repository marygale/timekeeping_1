<?php
/**
 * Created by PhpStorm.
 * User: abagasbas
 * Date: 1/31/18
 * Time: 5:23 PM
 */


abstract class RecordHelper{

    const months_map = [
        1 =>   'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ];

    const starting_year = 2017;
    const ending_year = 2018;

    public static function years()
    {
        $starting_year  = self::starting_year;
        $ending_year    = self::ending_year;

        for($starting_year; $starting_year <= $ending_year; $starting_year++)
            $years[$starting_year] = $starting_year;

        return $years;

    }

}