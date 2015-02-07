<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use SimpleTracker\Duration\Duration;
use SimpleTracker\Project\Sprint;
use SimpleTracker\Task\Task;

/**
 * Defines application features from the specific context.
 */
class ProjectManagerContext implements Context, SnippetAcceptingContext
{
    use ProjectManagerDictionary;

    /**
     * @var Sprint
     */
    private $sprint;

    /**
     * @var Task
     */
    private $task;

    /**
     * @Given a sprint named :name with a duration of :duration hours
     */
    public function aSprintNamedWithADurationOfHours($name, Duration $duration)
    {
        $this->sprint = Sprint::namedWithDuration($name, $duration);
    }

    /**
     * @Given a task :name with an estimate of :duration hours
     */
    public function aTaskWithAnEstimateOfHours($name, Duration $duration)
    {
        $aTask = Task::named($name);
        $aTask->estimate($duration);

        $this->task = $aTask;
    }

    /**
     * @When I choose to assign the task :name to the given sprint
     */
    public function iChooseToAssignTheTaskToTheGivenSprint($name)
    {
        $this->sprint->assignTask($this->task);
    }

    /**
     * @Then the given sprint should be filled with :arg1 task
     */
    public function theGivenSprintShouldBeFilledWithTask($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the given sprint estimate should be :arg1 hours
     */
    public function theGivenSprintEstimateShouldBeHours($arg1)
    {
        throw new PendingException();
    }
}
