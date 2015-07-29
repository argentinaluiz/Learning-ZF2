<?php

namespace Bookstore\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class CategoryTable extends AbstractTableGateway
{
    protected $table = "category";

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->getArrayObjectPrototype(new Category());
        $this->initialize();
    }
}