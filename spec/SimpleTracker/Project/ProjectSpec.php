<?php

namespace spec\SimpleTracker\Project;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleTracker\Project\Project;

/**
 * @mixin Project
 */
class ProjectSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SimpleTracker\Project\Project');
    }

    function let()
    {
        $this->beConstructedThrough('named', ["Awesome project"]);
    }

    function it_can_set_the_name()
    {
        $this->setName('More awesome project');
    }

    function it_can_get_the_name()
    {
        $this->getName()->shouldBe('Awesome project');

        $this->setName('More awesome project');
        $this->getName()->shouldBe('More awesome project');
    }

    function it_can_get_the_slug()
    {
        $this->getSlug()->shouldBe('awesome-project');
    }
}
