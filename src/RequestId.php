<?php

class RequestId
{
	private $value;

    public function __construct($value)
    {
    	if (!is_string($value)) {
    		$given_type = gettype($value);
    		throw new \InvalidArgumentException("Request-ID must be a string, \"{$given_type}\" given.");
    	}
    	$this->value = $value;
    }

    public static function generate()
    {
		return new self(sha1(uniqid()));    	
    }

    public function isEqualTo($other)
    {
    	return $this->value === $other->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
