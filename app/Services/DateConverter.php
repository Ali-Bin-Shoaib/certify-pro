<?php
class DateConverter
{
    public static function convert($date)
    {
        if (is_string($date)) {
            $date = date("Y-m-d", strtotime($date));
        }
    }
}
