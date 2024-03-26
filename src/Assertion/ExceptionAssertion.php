<?php
namespace App\Assertion;
class ExceptionAssertion extends \Exception
{
    private $_resulted;
    private $_expected;
    public function getExpected():Object
    {
        return $this->_expected;
    }
    public function getResulted(): Object
    {
        return $this->_resulted;
    }
    public function __construct(Object $expected,Object $resulted) {
        parent::__construct('Le résultat attendu est différent du résultat obtenu.');
        $this->_resulted = $resulted;
        $this->_expected = $expected;
    }
}