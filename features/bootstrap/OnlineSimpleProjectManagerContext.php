<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use SimpleTracker\Project\Project;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * Defines application features from the specific context.
 */
class OnlineSimpleProjectManagerContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /** @var Project */
    private $project;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @BeforeScenario
     */
    public function cleanDatabase()
    {
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        if (!empty($metadata)) {
            $tool = new SchemaTool($this->entityManager);
            $tool->dropSchema($metadata);
            $tool->createSchema($metadata);
        }
    }

    /**
     * @Given there is a project named :name
     */
    public function thereIsAProjectNamed($name)
    {
        $this->project = Project::named($name);
        $this->entityManager->persist($this->project);
        $this->entityManager->flush();
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
