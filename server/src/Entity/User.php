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
     * @var integer
     * @ORM\OneToOne(targetEntity="Clas")
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
     * @return int
     */
    public function getClassId(): int
    {
        return $this->classId;
    }

    /**
     * @param int $classId
     */
    public function setClassId(int $classId): void
    {
        $this->classId = $classId;
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

    public function __construct(int $classId, bool $move, string $username)
    {
        $this->classId = $classId;
        $this->move = $move;
        $this->username = $username;
    }
}