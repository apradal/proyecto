<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 26/11/2017
 * Time: 13:45
 */

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class Utils extends Middleware
{
    /**
     * @param $dates
     * @return array
     * Change the format from MySql to the typical d-m-Y of Spain.
     */
    public static function changeDateFormat($dates)
    {
        //changes on date format.
        $startTime = strtotime($dates[0]);
        $newStart = date('d-m-Y',$startTime);
        $endTime = strtotime($dates[1]);
        $newEnd = date('d-m-Y',$endTime);

        return array($newStart, $newEnd);
    }

    public static function addUserRole($user, $activites)
    {
        foreach ($activites as $activity) {
            $user_role = DB::table('activity_user')
                ->select('user_role')
                ->where('activity_id', '=', $activity->id)
                ->where('user_id', '=', $user->id)
                ->value('user_role');
            $activity->user_role = $user_role;
        }
    }

}