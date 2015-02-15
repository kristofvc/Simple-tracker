<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use SimpleTracker\Project\Project;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class OnlineSimpleProjectManagerContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    /** @var Project */
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
        $this->getSession()->visit('/project/' . urlencode($this->project->getSlug()));
        $this->assertSession()->elementExists('css', ".project-form");

        $form = $this->getSession()->getPage()->find('css', ".project-form");
        $form->fillField('form_name', $name);

        $form->submit();
    }

    /**
     * @Then the name of that project should be :arg1
     */
    public function theNameOfThatProjectShouldBe($arg1)
    {
        throw new PendingException();
    }
}
