<?php

namespace spec\SimpleTracker\Task;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TaskEstimateTooLongSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SimpleTracker\Task\TaskEstimateTooLong');
    }

    function it_should_be_a_runtimeexception()
    {
        $this->shouldHaveType('\RuntimeException');
    }
}
