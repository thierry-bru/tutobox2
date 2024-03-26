<?php
namespace App\Assertion;
abstract class Assertion{
    protected $_resulted;
    protected $_expected;
    public abstract function check():bool;
    public abstract function getExpected():Object;
    public abstract function getResulted():Object;
    
}