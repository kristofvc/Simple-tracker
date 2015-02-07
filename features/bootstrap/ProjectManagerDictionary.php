<?php

use SimpleTracker\Duration\Duration;

trait ProjectManagerDictionary
{
    /**
     * @Transform :duration
     */
    public function transformStringToDuration($string)
    {
        return Duration::hours((int)$string);
    }
}