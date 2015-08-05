<?php

namespace User\Service;

use User\Service\AbstractService;
use Doctrine\ORM\EntityManager;

use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;

use Base\Mail\Mail;

class User extends AbstractService
{
    /**
     * @var SmtpTransport
     */
    protected $transport;

    /**
     * @var
     */
    protected $view;

    /**
     * User constructor.
     * @param $transport
     */
    public function __construct(EntityManager $em, SmtpTransport $transport, $view)
    {
        parent::__construct($em);

        $this->entity = 'User\Entity\User';
        $this->transport = $transport;
        $this->view = $view;
    }

    /**
     * Insert User and Send Email
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        $entity = parent::insert($data);

        $dataEmail = array('name'=>$data['name'],'activationKey'=>$entity->getActivationKey());

        if($entity) {
            $mail = new Mail($this->transport, $this->view, 'add-user');
            $mail->setSubject('Confirmação de cadastro')
                ->setTo($data['email'])
                ->setData($dataEmail)
                ->prepare()
                ->send();

            return $entity;
        }
    }

    public function activate($key)
    {
        $repository = $this->em->getRepository('User\Entity\User');

        $user = $repository->findOneByActivationKey($key);

        if ($user && !$user->getActive()) {
            $user->setActive(true);

            $this->em->persist($user);
            $this->em->flush();

            return $user;
        }
    }
}
