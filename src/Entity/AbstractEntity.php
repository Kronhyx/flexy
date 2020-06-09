<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class AbstractEntity
 * @package App\Entity
 */
abstract class AbstractEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected ?int $id;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}