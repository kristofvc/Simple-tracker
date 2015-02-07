<?php

namespace spec\SimpleTracker\Project;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleTracker\Project\Sprint;
use SimpleTracker\Task\Task;

/**
 * @mixin Sprint
 */
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

    function it_lets_someone_assign_a_task()
    {
        $this->assignTask(Task::named('Awesome task'));
    }
}
