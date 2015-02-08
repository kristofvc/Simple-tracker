<?php

namespace SimpleTracker\Project;

use SimpleTracker\Duration\Duration;
use SimpleTracker\Task\Task;

class Sprint implements \Countable
{
    private $tasks = [];

    public static function namedWithDuration($argument1, $argument2)
    {
        $sprint = new Sprint();

        // TODO: write logic here

        return $sprint;
    }

    public function assignTask(Task $task)
    {
        $this->tasks[] = $task;
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
