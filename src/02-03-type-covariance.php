<?php 
print("PHP version: " . phpversion() . "\n");

class A {
  public function check() {
    print("A\n");
  }
}

class B extends A {
  public function check() {
    print("B\n");
  }
}

class Producer {
    public function method(): A {
      print("Producer:");
      return new A();
    }
}

class ChildProducer extends Producer {
    public function method(): B {
      print("ChildProducer:");      
      return new B();
    }
}

$producer = new Producer();
$producer->method()->check();

$childProducer = new ChildProducer();
$childProducer->method()->check();
