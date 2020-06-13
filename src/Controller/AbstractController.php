<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as BaseAbstractController;

/**
 * Class AbstractController
 * @package App\Controller
 */
abstract class AbstractController extends BaseAbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $manager;

    /**
     * AbstractController constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string $msg
     * @throws EntityNotFoundException
     */
    protected function throwEntityNotFound($msg = 'This element has not been found'): void
    {
        throw new EntityNotFoundException($msg);
    }

    /**
     * @param string $type
     * @param string $message
     */
    protected function sendNotification(string $message, string $type = 'success'): void
    {
        $object['type'] = $type;
        $object['message'] = $message;

        // The reason to use session->getFlashBag instead this->addFlash is cause addFlass method only accept a string as parameter
        // is necesary send a custom object to send notification type
        $flashBag = $this->get('session')->getFlashBag();
        $flashBag->add('bootstrap', $object);
    }
}
