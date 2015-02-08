<?php

namespace SimpleTracker\Duration;

class Duration
{
    private $hours;

    public static function hours($hours)
    {
        $duration = new Duration();
        $duration->hours = $hours;

        return $duration;
    }

    public function add(Duration $duration)
    {
        return Duration::hours($this->hours + $duration->hours);
    }
}
