<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('RequestId');
    }
}
