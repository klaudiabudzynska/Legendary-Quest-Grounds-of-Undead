<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var HeroClass
     * @ORM\OneToOne(targetEntity="HeroClass")
     */
    private $class;

    /**
     * @var string
     * @ORM\Column(name="username")
     */
    private $username;

    /**
     * @var bool
     * @ORM\Column(name="move", type="boolean")
     */
    private $move;

    /**
     * @var int
     * @ORM\Column(name="owner_id")
     */
    private $owner_id;

    /**
     * @var bool
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var int
     * @ORM\Column(name="health")
     */
    private $health;

    /**
     * @var int
     * @ORM\Column(name="strength")
     */
    private $strength;

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     */
    public function setStrength(int $strength): void
    {
        $this->strength = $strength;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     */
    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    /**
     * @return HeroClass
     */
    public function getClass(): HeroClass
    {
        return $this->class;
    }

    /**
     * @param HeroClass $class
     */
    public function setClass(HeroClass $class): void
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return bool
     */
    public function isMove(): bool
    {
        return $this->move;
    }

    /**
     * @param bool $move
     */
    public function setMove(bool $move): void
    {
        $this->move = $move;
    }

    public function __construct(HeroClass $class, bool $move, string $username)
    {
        $this->class = $class;
        $this->move = $move;
        $this->username = $username;
    }

    public function getOwnerId(): int
    {
        return $this->owner_id;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}