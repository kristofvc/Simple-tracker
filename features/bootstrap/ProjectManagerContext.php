<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use SimpleTracker\Duration\Duration;
use SimpleTracker\Project\Sprint;
use SimpleTracker\Task\Task;
use SimpleTracker\Task\TaskEstimateTooLong;
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
     * @var Task[]
     */
    private $tasks = [];

    private $exception;

    /**
     * @Given a sprint named :name with a duration of :duration hour(s)
     */
    public function aSprintNamedWithADurationOfHours($name, Duration $duration)
    {
        $this->sprint = Sprint::namedWithDuration($name, $duration);
    }

    /**
     * @Given a task :name with an estimate of :duration hour(s)
     */
    public function aTaskWithAnEstimateOfHours($name, Duration $duration)
    {
        $aTask = Task::named($name);
        $aTask->estimate($duration);

        $this->tasks[$name] = $aTask;
    }

    /**
     * @When I choose to assign the task :name to the given sprint
     */
    public function iChooseToAssignTheTaskToTheGivenSprint($name)
    {
        try {
            $this->sprint->assignTask($this->tasks[$name]);
        } catch (TaskEstimateTooLong $e) {
            $this->exception = $e;
        }
    }

    /**
     * @Then the given sprint should be filled with :count task(s)
     */
    public function theGivenSprintShouldBeFilledWithTask($count)
    {
        Assert::assertCount($count, $this->sprint);
    }

    /**
     * @Then the given sprint estimate should be :duration hour(s)
     */
    public function theGivenSprintEstimateShouldBeHours($duration)
    {
        Assert::assertEquals($duration, $this->sprint->getEstimate());
    }

    /**
     * @Then I should be notified that the task estimate is too long for the given sprint
     */
    public function iShouldBeNotifiedThatTheTaskEstimateIsTooLongForTheGivenSprint()
    {
        Assert::assertInstanceOf(TaskEstimateTooLong::class, $this->exception);
    }
}
