<?php

namespace SimpleTracker\Project;

use SimpleTracker\Duration\Duration;
use SimpleTracker\Task\Task;

class Sprint implements \Countable
{
    private $tasks = [];

    /**
     * @var Duration
     */
    private $duration;

    public static function namedWithDuration($name, Duration $duration)
    {
        $sprint = new Sprint();
        $sprint->duration = $duration;

        return $sprint;
    }

    public function assignTask(Task $task)
    {
        if ($this->getEstimate()->toHours() + $task->getEstimate()->toHours() <= $this->duration->toHours()) {
            $this->tasks[] = $task;
        }
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return count($this->tasks);
    }

    public function getEstimate()
    {
        $estimate = Duration::hours(0);
        /** @var Task $task */
        foreach ($this->tasks as $task) {
            $estimate = $estimate->add($task->getEstimate());
        }

        return $estimate;
    }
}
