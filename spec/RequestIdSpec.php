<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestIdSpec extends ObjectBehavior
{
	private $string_id = '8614afff87149f0e72f5dfc115ca1fdcaa1f76e3';

	function let()
	{
		$this->beConstructedWith($this->string_id);
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('RequestId');
    }

    function it_displays_itself()
    {
    	$this->__toString()->shouldReturn($this->string_id);
    }

    function it_returns_and_error_if_value_is_not_a_string()
    {
    	$this->shouldThrow('Exception')->during('__construct', array(1,2));
    	$this->shouldThrow('Exception')->during('__construct', array(-2));
    	$this->shouldThrow('Exception')->during('__construct', array(new \stdClass));
    	$this->shouldThrow('Exception')->during('__construct', array(true));
    }

    function it_should_generate_new_request_id_object()
    {
    	$this->generate()->shouldBeAnInstanceOf('RequestId');
    }

    function it_should_say_if_two_objects_are_equals()
    {
    	$this->isEqualTo(new \RequestId($this->string_id))->shouldReturn(true);
    	$this->isEqualTo(new \RequestId("some explicit id"))->shouldReturn(false);
    }
}
