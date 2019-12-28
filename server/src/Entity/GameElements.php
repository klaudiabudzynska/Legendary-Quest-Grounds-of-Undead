<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Serializer;

/**
 * @ORM\Table(name="game_elements")
 * @ORM\Entity(repositoryClass="\App\Repository\GameElementsRepository")
 */
class GameElements
{
    /**
     * @var int
     * @ORM\Column()
     * @ORM\GeneratedValue()
     * @ORM\Id()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column()
     */
    private $name;

    /**
     * @var string
     * @ORM\Column()
     */
    private $description;

    /**
     * @var int
     * @ORM\Column()
     */
    private $weight;

    /**
     * @var bool
     * @ORM\Column(name="can_move", type="boolean")
     */
    private $canMove;

    /**
     * @var int
     * @ORM\Column()
     */
    private $height;

    /**
     * @var int
     * @ORM\Column()
     */
    private $width;

    /**
     * @var int
     * @ORM\Column(name="type")
     */
    private $type;

    /**
     * @var array
     */
    private $coordinates = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function isCanMove(): bool
    {
        return $this->canMove;
    }

    public function setCanMove(bool $canMove): void
    {
        $this->canMove = $canMove;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

}