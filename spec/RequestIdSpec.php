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

    function it_should_generate_new_request_id_object_from_other()
    {
    	$this->generateFromOther(new \RequestId("1m3ne2"))->__toString()->shouldEndsWith(';1m3ne2');
    	$this->generateFromOther(
    		new \RequestId("1m3ne2", 
    			new \RequestId("4234ds", 
    				new \RequestId("09942a")
    			)
    		)
    	)->__toString()->shouldEndsWith(';09942a');
    }

    function it_should_say_if_two_objects_are_equals()
    {
    	$this->isEqualTo(new \RequestId($this->string_id))->shouldReturn(true);
    	$this->isEqualTo(new \RequestId("some explicit id"))->shouldReturn(false);
    }

    function it_should_display_concatenated_two_requests()
    {
    	$request1_string	= "938f93";
    	$request1_id		= new \RequestId($request1_string);

    	$this->beConstructedWith($this->string_id, $request1_id);
    	$this->__toString()->shouldReturn("{$this->string_id};{$request1_string}");
    }

    function it_should_display_concatenated_n_requests()
    {
    	$request1_string	= "938f93";
    	$request1_id		= new \RequestId($request1_string);

    	$request2_string	= "3mk8rr";
    	$request2_id		= new \RequestId($request2_string, $request1_id);

    	$request3_string	= "kij12b";
    	$request3_id		= new \RequestId($request3_string, $request2_id);

    	$this->beConstructedWith($this->string_id, $request3_id);
    	$this->__toString()->shouldReturn("{$this->string_id};{$request3_string};{$request2_string};{$request1_string}");
    }

    public function getMatchers()
    {
        return [
            'endsWith' => function($subject, $value) {
                return preg_match("/{$value}/", $subject);
            },
        ];
    }
}
