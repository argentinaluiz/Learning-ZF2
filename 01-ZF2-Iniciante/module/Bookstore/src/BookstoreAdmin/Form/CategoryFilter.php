<?php

namespace BookstoreAdmin\Form;

use Zend\InputFilter\InputFilter;

class CategoryFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim']
            ],
            'validator' => [
                ['name' => 'NotEmpty'],
                'options' => [
                    'messages' => [
                        'isEmpty' => 'Insira um Nome para a Categoria'
                    ]
                ]
            ]
        ]);
    }
}