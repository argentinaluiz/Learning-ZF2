<?php

namespace BookstoreAdmin\Form;

use Zend\Form\Form;

class Category extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('category');

        $this->setAttribute('method', 'POST')
            ->setAttributes([
                'class'=> 'form-horizontal',
            ]);
        $this->setInputFilter(new CategoryFilter());

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
            ],
            'attributes' => [
                'id' => 'name',
                'placeholder' => 'Nome da Categoria',
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => [
                'value' => 'Salvar',
                'class' => 'btn-success'
            ]
        ]);
    }
}