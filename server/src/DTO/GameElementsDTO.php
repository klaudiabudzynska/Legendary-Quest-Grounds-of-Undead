<?php


namespace App\DTO;


use App\Entity\GameElements;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="game_elements")
 * @ORM\Entity(repositoryClass="\App\Repository\GameElementsRepository")
 */
class GameElementsDTO
{

    public const HORIZONTAL = "H";
    public const VERTICAL = "V";
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $angle;
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var bool
     */
    private $canMove;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $type;

    /**
     * @var array
     */
    private $coordinates = [];

    public function __construct(GameElements $element)
    {
        $this->name = $element->getName();
        $this->id = time();
        $this->type = $element->getType();
        $this->angle = $element->getAngle();
        $this->canMove = $element->isCanMove();
        $this->coordinates = [];
        $this->description = $element->getDescription();
        $this->height = $element->getHeight();
        $this->weight = $element->getWeight();
        $this->width = $element->getWidth();
    }


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

    public function getAngle(): ?string
    {
        return $this->angle;
    }

    public function setAngle(string $angle): void
    {
        $this->angle = $angle;
    }

}