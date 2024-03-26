<?php
namespace App\Assertion;
class TestResultat
{
    private $_resulted;
    private $_expected;
    private $_message;
    private $_isSuccessfull;
    public function getMessage():string
    {
        return $this->_message;
    }
    public function getExpected():?Object
    {
        return $this->_expected;
    }
    public function getResulted(): ?Object
    {
        return $this->_resulted;
    }
    public function getIsSuccessfull(): bool
    {
        return $this->_isSuccessfull;
    }
    public function getExpectedToArray(): array
    {
        return get_object_vars($this->_resulted);
    }
    public function __construct(?Object $expected,?Object $resulted, string $message,$isSuccessfull=true) {

        $this->_resulted = $resulted;
        $this->_expected = $expected;
        $this->_message = $message;
        $this->_isSuccessfull=$isSuccessfull;
    }
}
