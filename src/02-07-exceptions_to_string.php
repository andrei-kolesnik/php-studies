<?php 
print("PHP version: " . phpversion() . "\n");

class TestClass
{
  public $data;
  
  public function __construct($data = null)
  {
    $this->data = $data;
  }
  
  public function __toString()
  {
    if (is_null($this->data)) {
      throw new \Exception("Not initialized");
    } else {
      return (string)$data;
    }
  }
}

$test = new TestClass();
try {
  print("$test");
} catch (\Exception $e) {
  print($e->getMessage());
}
