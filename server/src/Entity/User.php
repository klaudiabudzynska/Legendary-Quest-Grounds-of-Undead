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
     * @ORM\Column(name="class_id")
     */
    private $classId;

    /**
     * @var string
     * @ORM\Column(name="username")
     */
    private $username;

    /**
     * @var boolean
     * @ORM\Column(name="move")
     */
    private $move;


}