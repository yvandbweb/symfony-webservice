<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nameuser", type="string", length=255, nullable=true)
     */
    private $nameuser;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=true)
     */
    private $datetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameuser(): ?string
    {
        return $this->nameuser;
    }

    public function setNameuser(?string $nameuser): self
    {
        $this->nameuser = $nameuser;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(?\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }


}
