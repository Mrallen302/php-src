--TEST--
Serialization of properties should not deal INDIRECT entries to userland
--FILE--
<?php

class MyArrayObject extends ArrayObject {
    private $unused = 123;
    public function __construct(array $array)
    {
        parent::__construct($array, 1);
    }
}

class MySplDoublyLinkedList extends SplDoublyLinkedList {
    private $unused = 123;
}

class MySplObjectStorage extends SplObjectStorage {
    private $unused = 123;
}

$x = new MyArrayObject([]);
var_dump($x->__serialize());

$x = new MySplDoublyLinkedList();
var_dump($x->__serialize());

$x = new MySplObjectStorage();
var_dump($x->__serialize());

?>
--EXPECT--
array(4) {
  [0]=>
  int(1)
  [1]=>
  array(0) {
  }
  [2]=>
  array(1) {
    [" MyArrayObject unused"]=>
    int(123)
  }
  [3]=>
  NULL
}
array(3) {
  [0]=>
  int(0)
  [1]=>
  array(0) {
  }
  [2]=>
  array(1) {
    [" MySplDoublyLinkedList unused"]=>
    int(123)
  }
}
array(2) {
  [0]=>
  array(0) {
  }
  [1]=>
  array(1) {
    [" MySplObjectStorage unused"]=>
    int(123)
  }
}
