<?php

namespace spec\SimpleTracker\Duration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SimpleTracker\Duration\Duration');
    }

    function let()
    {
        $this->beConstructedThrough('hours', [2]);
    }
}
