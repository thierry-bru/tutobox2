<?php
namespace App\Assertion;
use App\Entity\Exercice;
use Ds\Collection as Collection;
use App\Assertion\AssertionObject;
class TestCollection implements Collection
{
 private \ArrayObject $_tests;
 private ResultatCollection $_resultats;
 private bool $_resultatGlobal;
 private bool $_testFailedtGlobal;

 private string $_codeBase;
 private string $_codeTest;
 private string $_codeAttendu;
public function __construct(Exercice $exercice) {
    $this->_tests= new \ArrayObject();
    $this->_resultats= new ResultatCollection();
    $this->_codeBase =$exercice->getCodeBase();
    $this->_codeTest = $exercice->getCodeTest();
    $this->_codeAttendu = $exercice->getCodeAttendu();
    $this->_testFailedtGlobal = 0;
    $this->_resultatGlobal = false;

}
#region interfaces
public function clear(): void
{
    foreach ($this->_tests as $value) {
        unset($value);
    }
    $this->_tests = new \ArrayObject();
}
public function  copy(): Collection
{
    return clone $this;
}
public function  isEmpty(): bool
{
    return count($this->_tests)==0;
}
public function  toArray(): array
{
return (array)$this->_tests;
}
public function count():int
{
    return count($this->_tests);
}
public function getIterator(): \Traversable {
    return new \ArrayIterator($this->_tests);
}
public function jsonSerialize(): mixed
{
    return json_encode($this->_tests);
}
#endregion
public function run($codeSaisi):ResultatCollection
{
    $this->_resultatGlobal = true;
  
    return $this->testCode($codeSaisi);
}

private function testCode($codeSaisi):ResultatCollection
{
    try {
        $codeToRun="declare(strict_types=1);".$this->_codeBase.$codeSaisi.$this->_codeAttendu.$this->_codeTest;
    eval($codeToRun);
    } catch (\Exception $e) {
        $this->_resultatGlobal = false;
        $this->addResultat(new TestResultat(null,null,"Execution:".$e->getMessage()."[".$codeToRun."]",false));
        $this->_testFailedtGlobal +=1;
        return $this->_resultats;
    }
    foreach ($this->_tests as $test) 
    {
        try
        {
            if ($test->check()==false)
            {
                throw new ExceptionAssertion($test->getExpected(),$test->getResulted());
            }
            $this->addResultat(new TestResultat($test->getExpected(),$test->getResulted(),"Le résultat obtenu est valide",true));
        }
        catch (ExceptionAssertion $e)
            {
                $this->_resultatGlobal = false;
                $this->_testFailedtGlobal +=1;
                $this->addResultat(new TestResultat($test->getExpected(),$test->getResulted(),"ExceptionAssertion: Le résultat attendu ne correspond pas",false));
            }
        catch(\Exception $e)
            {
                $this->_resultatGlobal = false;
                $this->addResultat(new TestResultat(null,null,"Exception:".$e->getMessage(),false));
                $this->_testFailedtGlobal +=1;
            }    
    }
    return $this->_resultats;
   
}
public function addTest(Assertion $assertion)
{
    $this->_tests->append($assertion);
}
private function addResultat(TestResultat $testResultat)
{
    $this->_resultats->addResultat($testResultat);
}

public function testCount():int
{
    return count($this->_tests);
}

public function getResultats():ResultatCollection
{
    return $this->_resultats;
}
}
