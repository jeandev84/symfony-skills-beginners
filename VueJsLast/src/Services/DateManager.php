<?php
namespace App\Services;


/**
 * Class DateManager
 * @package App\Services
*/
class DateManager
{

    /**
     * @param string $timezone
     * @return \DateTime
     * @throws \Exception
    */
    public function getDateFromTimezone(string $timezone)
    {
        $utc = new \DateTimeZone("UTC");
        $newTimeZone = new \DateTimeZone($timezone);
        $date = new \DateTime('now', $utc);
        $date->setTimezone($newTimeZone);

        return $date;
    }
}