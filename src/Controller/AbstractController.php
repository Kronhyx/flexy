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
}
