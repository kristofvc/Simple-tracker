<?php

namespace spec\SimpleTracker\Duration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleTracker\Duration\Duration;

/**
 * @mixin Duration
 */
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

    function it_can_be_added_to_other_duration()
    {
        $newDuration = $this->add(Duration::hours(2));
        $newDuration->shouldHaveType('SimpleTracker\Duration\Duration');
        $newDuration->shouldBeLike(Duration::hours(4));
    }

    function it_can_convert_to_hours()
    {
        $this->toHours()->shouldReturn(2);
    }
}
