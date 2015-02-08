<?php

namespace SimpleTracker\Task;

use SimpleTracker\Duration\Duration;

class Task
{
    private $estimate;

    public static function named($argument1)
    {
        $task = new Task();

        // TODO: write logic here

        return $task;
    }

    public function estimate(Duration $duration)
    {
        $this->estimate = $duration;
    }

    public function getEstimate()
    {
        return $this->estimate;
    }
}
