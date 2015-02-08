<?php

namespace spec\SimpleTracker\Project;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleTracker\Duration\Duration;
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
        $this->beConstructedThrough('namedWithDuration', ['Awesome sprint', Duration::hours(2)]);
    }

    function it_is_countable()
    {
        $this->shouldHaveType('\Countable');
    }

    function it_lets_someone_assign_a_task()
    {
        $task = Task::named('Awesome task');
        $task->estimate(Duration::hours(2));
        $this->assignTask($task);
    }

    function it_lets_count_tasks()
    {
        $this->count()->shouldBe(0);

        $task = Task::named('Awesome task 1');
        $task->estimate(Duration::hours(1));
        $this->assignTask($task);
        $this->count()->shouldBe(1);

        $task2 = Task::named('Awesome task 2');
        $task2->estimate(Duration::hours(1));
        $this->assignTask($task2);
        $this->count()->shouldBe(2);
    }

    function it_can_get_the_estimate()
    {
        $this->getEstimate()->shouldHaveType('SimpleTracker\Duration\Duration');
        $this->getEstimate()->shouldBeLike(Duration::hours(0));
    }
}
