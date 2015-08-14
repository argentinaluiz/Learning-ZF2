<?php

namespace CJSN\Controller;


class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckIfTheClassExist()
    {
        $class = 'CJSN\Entity\Task';
        $this->assertTrue(class_exists($class),
            'Class not Found');
    }
}