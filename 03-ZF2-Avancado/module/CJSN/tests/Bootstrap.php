<?php

namespace CJSN;


class Bootstrap
{
    /**
     * @var \Zend\Mvc\Application
     */
    protected $bootstrap;
    public function __construct() {
        $this->bootstrap = \Zend\Mvc\Application::init(include 'config/test.config.php');
    }
    /**
     * @return \Zend\Mvc\Application
     */
    public function getBootstrap() {
        return $this->bootstrap;
    }
    public static function getConfig() {
        return include 'config/test.config.php';
    }
}