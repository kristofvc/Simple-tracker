<?php

namespace spec\SimpleTracker\Project;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SprintSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SimpleTracker\Project\Sprint');
    }

    function let()
    {
        $this->beConstructedThrough('namedWithDuration', ['Awesome sprint', 2]);
    }
}
