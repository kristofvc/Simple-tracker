<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use SimpleTracker\Project\Project;

/**
 * Defines application features from the specific context.
 */
class SimpleProjectManagerContext implements Context, SnippetAcceptingContext
{
    /**
     * @var Project
     */
    private $project;

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
     * @Given there is a project named :name
     */
    public function thereIsAProjectNamed($name)
    {
        $this->project = Project::named($name);
    }

    /**
     * @When I change the name of that project to :name
     */
    public function iChangeTheNameOfThatProjectTo($name)
    {
        $this->project->setName($name);
    }

    /**
     * @Then the name of that project should be :arg1
     */
    public function theNameOfThatProjectShouldBe($arg1)
    {
        throw new PendingException();
    }
}
