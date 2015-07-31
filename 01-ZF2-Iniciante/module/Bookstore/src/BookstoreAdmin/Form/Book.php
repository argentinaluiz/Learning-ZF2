<?php

namespace BookstoreAdmin\Form;

use Doctrine\ORM\EntityManager;
use Zend\Form\Form;
use Zend\Form\Element\Select;

class Book extends Form
{
    protected $categories;

    public function __construct($name = null, array $categories = null)
    {
        parent::__construct('book');

        $this->categories = $categories;

        $this->setAttribute('method', 'POST')
            ->setAttributes([
                'class'=> 'form-horizontal',
            ]);
//        $this->setInputFilter(new CategoryFilter());

        $this->add([
            'name' => 'id',
            'attributes' => [
                'type' => 'hidden'
            ]
        ]);

        $this->add([
            'name' => 'name',
            'options' => [
                'type' => 'text',
                'label' => 'Nome: ',
                'label_attributes' => [
                    'class'  => 'control-label'
                ],
            ],
            'attributes' => [
                'id' => 'name',
                'placeholder' => 'Nome do Livro',
                'class' => 'form-control'
            ]
        ]);

        $category = new Select();
        $category->setLabel('Categoria:')
            ->setName('categories')
            ->setOptions([
                'value_options' => $this->categories
            ])
            ->setAttributes([
                'class'=> 'form-control',
            ]);
        $this->add($category);

        $this->add([
            'name' => 'author',
            'options' => [
                'type' => 'text',
                'label' => 'Autor: ',
                'label_attributes' => [
                    'class'  => 'control-label'
                ],
            ],
            'attributes' => [
                'id' => 'author',
                'placeholder' => 'Autor do Livro',
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'name' => 'isbn',
            'options' => [
                'type' => 'text',
                'label' => 'ISBN: ',
                'label_attributes' => [
                    'class'  => 'control-label'
                ],
            ],
            'attributes' => [
                'id' => 'isbn',
                'placeholder' => 'ISBN do Livro',
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'name' => 'price',
            'options' => [
                'type' => 'text',
                'label' => 'Valor: ',
                'label_attributes' => [
                    'class'  => 'control-label'
                ],
            ],
            'attributes' => [
                'id' => 'price',
                'placeholder' => 'Valor do Livro',
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => [
                'value' => 'Salvar',
                'class' => 'btn alert-success'
            ]
        ]);
    }
}