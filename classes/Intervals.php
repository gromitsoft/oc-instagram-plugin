<?php

namespace GromIT\Instagram\Classes;

use DateInterval;

class Intervals
{
    public static function fifteenMinutes(): DateInterval
    {
        return new DateInterval('PT15M');
    }

    public static function oneHour(): DateInterval
    {
        return new DateInterval('PT1H');
    }

    public static function oneDay(): DateInterval
    {
        return new DateInterval('P1D');
    }
}
