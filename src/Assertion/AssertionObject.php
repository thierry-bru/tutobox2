<?php
namespace App\Assertion;
class AssertionObject extends Assertion
{
    public function __construct(Object $resulted,Object $expected) {
        $this->_resulted = $resulted;
        $this->_expected = $expected;
    }
    public function check():bool
    {
        $valuesResulted=get_object_vars($this->_resulted);
        $valuesExpected=get_object_vars($this->_expected);
        if (count($valuesResulted)!=count($valuesExpected))
        return false;
        foreach ($valuesExpected as $key => $value) {
            if (!isset($valuesResulted[$key])||$valuesResulted[$key]!=$value)
                return false;
        }
        return true;
    }
    public function getExpected():Object
    {
        return $this->_expected;
    }
    public function getResulted(): Object
    {
        return $this->_resulted;
    }
}