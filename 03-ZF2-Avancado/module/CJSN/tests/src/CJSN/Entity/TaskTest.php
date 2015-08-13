<?php

namespace CJSN\Entity;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckIfTheClassExist()
    {
        $this->assertTrue(
            class_exists($classe = 'CJSN\Entity\Task'),
            "The class {$classe} not Found"
        );
    }
}