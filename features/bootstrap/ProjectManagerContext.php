<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use SimpleTracker\Duration\Duration;
use SimpleTracker\Project\Sprint;
use SimpleTracker\Task\Task;
use PHPUnit_Framework_Assert as Assert;

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
     * @Then the given sprint should be filled with :count task
     */
    public function theGivenSprintShouldBeFilledWithTask($count)
    {
        Assert::assertCount($count, $this->sprint);
    }

    /**
     * @Then the given sprint estimate should be :duration hours
     */
    public function theGivenSprintEstimateShouldBeHours($duration)
    {
        Assert::assertEquals($duration, $this->sprint->getEstimate());
    }
}
