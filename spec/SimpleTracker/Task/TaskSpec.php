<?php

namespace spec\SimpleTracker\Task;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleTracker\Duration\Duration;
use SimpleTracker\Task\Task;

/**
 * @mixin Task
 */
class TaskSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SimpleTracker\Task\Task');
    }

    function let()
    {
        $this->beConstructedThrough('named', ['Awesome task']);
    }

    function it_can_add_an_estimate()
    {
        $this->estimate(Duration::hours(2));
    }
}
