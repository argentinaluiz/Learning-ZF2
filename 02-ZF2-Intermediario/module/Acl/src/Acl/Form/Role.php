<?php

namespace Acl\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select;

class Role extends Form
{
    protected $parent;

    public function __construct($name = null, array $parent = null) {
        parent::__construct('roles');
        $this->parent  = $parent;

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

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
                'placeholder' => 'Digite seu Usuário',
                'class' => 'form-control'
            ]
        ]);

        $allParent = array_merge(array(0=>'Nenhum'),$this->parent);
        $parent = new Select();
        $parent->setLabel("Herda: ")
            ->setName("parent")
            ->setOptions(array('value_options' => $allParent));
        $this->add($parent);

        $isAdmin = new \Zend\Form\Element\Checkbox("isAdmin");
        $isAdmin->setLabel("Admin?: ");
        $this->add($isAdmin);
        
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