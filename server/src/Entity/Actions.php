<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActionsRepository")
 * @ORM\Table(name="Actions")
 */
class Actions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $item;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attack_mob_id;

    /**
     * @var integer
     * @ORM\Column(name="user_id")
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user->getId();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?int
    {
        return $this->item;
    }

    public function setItem(?int $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAttackMobId(): ?int
    {
        return $this->attack_mob_id;
    }

    public function setAttackMobId(?int $attack_mob_id): self
    {
        $this->attack_mob_id = $attack_mob_id;

        return $this;
    }

    public function getUser(): int 
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user->getId();
    }


}
