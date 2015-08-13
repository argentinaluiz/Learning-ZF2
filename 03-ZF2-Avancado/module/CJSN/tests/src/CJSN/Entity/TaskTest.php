<?php

namespace CJSN\Entity;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckIfTheClassExist()
    {
        $class = 'CJSN\Entity\Task';
        $this->assertTrue(class_exists($class), 'The class not Found');
    }
}
