<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class ProjectManagerContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given a sprint named :arg1 with a duration of :arg2 hours
     */
    public function aSprintNamedWithADurationOfHours($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given a task :arg1 with an estimate of :arg2 hours
     */
    public function aTaskWithAnEstimateOfHours($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When I choose to assign the task :arg1 to the given sprint
     */
    public function iChooseToAssignTheTaskToTheGivenSprint($arg1)
    {
        throw new PendingException();
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
