<?php

namespace App\Services;

use DateTime;

class SerializeDates
{
    public function getAllDatesDuringBookingPeriod(array $bookedDates): array
    {
        $dates = [];

        if (empty($bookedDates)) {
            return [];
        }

        foreach ($bookedDates as $startDate => $endDate) {
            $dates[] = $this->dates_between($startDate, $endDate);
        }



        return $this->generalize_dates($dates);
    }


    public function dates_between($start_date, $end_date)
    {
        $dates = array();
        $current_date = strtotime($start_date);
        $end_date = strtotime($end_date);

        while ($current_date <= $end_date) {
            $dates[] = date('Y-m-d', $current_date);
            $current_date = strtotime('+1 day', $current_date);
        }

        return $dates;
    }

    public function generalize_dates(array $dates): array
    {
        $allDates = [];

        foreach ($dates as $subArray) {
            $allDates = array_merge($allDates, $subArray);
        }

        return $this->date_filter(array_unique($allDates));
    }

    public function date_filter(array $dates): array
    {
        $currentDate = new DateTime();

        return array_filter($dates, function($date) use ($currentDate) {
            $dateObj = new DateTime($date);
            return $dateObj > $currentDate;
        });
    }

}
