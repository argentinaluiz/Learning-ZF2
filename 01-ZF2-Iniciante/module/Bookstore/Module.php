<?php

namespace Bookstore;

use Bookstore\Model\CategoryTable;
use Bookstore\Services\CategoryService;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Bookstore\Services\CategoryService' => function ($service) {
                    $dbAdapter = $service->get('Zend\Db\Adapter\Adapter');
                    $categoryTable = new CategoryTable($dbAdapter);
                    $categoryService = new CategoryService($categoryTable);

                    return $categoryService;
                }
            ]
        ];
    }
}
