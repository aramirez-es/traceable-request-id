<?php

class RequestId
{
	private $value;
	private $parent;

	private static $requests_separator = ';';

    public function __construct($value, RequestId $parent = null)
    {
    	$this->guardValue($value);
    	$this->value = $value;
    	$this->parent = $parent;
    }

    public static function generate()
    {
		return new self(self::generateUUID());
    }

    public function generateFromOther(RequestId $parent)
    {
		return new self(self::generateUUID(), $parent);
    }

    public function isEqualTo($other)
    {
    	return $this->value === $other->value;
    }

    public function __toString()
    {
    	if (empty($this->parent)) {
    		return $this->value;
    	}
        return implode(self::$requests_separator, array($this->value, $this->parent));
    }

    private function guardValue($value) {
    	if (!is_string($value)) {
    		$given_type = gettype($value);
    		throw new \InvalidArgumentException("Request-ID must be a string, \"{$given_type}\" given.");
    	}
    }

    private static function generateUUID() {
    	return sha1(uniqid());
    }
}
