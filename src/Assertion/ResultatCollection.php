<?php
namespace App\Assertion;
use Ds\Collection as Collection;
class ResultatCollection implements Collection
{

 private \ArrayObject $_resultats;
public function __construct() {
    $this->_resultats= new \ArrayObject();
}
#region interfaces
public function clear(): void
{
    foreach ($this->_resultats as $value) {
        unset($value);
    }
    $this->_resultats = new \ArrayObject();
}
public function  copy(): Collection
{
    return clone $this;
}
public function  isEmpty(): bool
{
    return count($this->_resultats)==0;
}
public function  toArray(): array
{
return (array)$this->_resultats;
}
public function count():int
{
    return count($this->_resultats);
}
public function getIterator(): \Traversable {
    return new \ArrayIterator($this->_resultats);
}
public function jsonSerialize(): mixed
{
    return json_encode($this->_resultats);
}
#endregion

public function addResultat(TestResultat $testResultat)
{
    $this->_resultats->append($testResultat);
}
public function getFailedNumber():int
{
    $nb=0;
    foreach ($this->_resultats as $resultat) {
        if (!$resultat->getIsSuccessfull())
        $nb++;
    }
    return $nb;
}
}