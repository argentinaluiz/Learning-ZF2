<?php

namespace Bookstore\Services;

use Bookstore\Model\CategoryTable;

class CategoryService
{
    /**
     * @var CategoryTable
     */
    protected $categoryTable;

    /**
     * CategoryService constructor.
     * @param $table
     */
    public function __construct(CategoryTable $table)
    {
        $this->categoryTable = $table;
    }

    public function fetchAll()
    {
        $resultSet = $this->categoryTable->select();

        return $resultSet;
    }
}
