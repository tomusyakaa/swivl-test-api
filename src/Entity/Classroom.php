<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClassroomRepository::class)
 */
class Classroom implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isActive = true;

    /**
     * Classroom constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->isActive  = true;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return $this
     * @throws \Exception
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = new \DateTime($createdAt);

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @throws \Exception
     * @ORM\PrePersist()
     */
    public function beforeSave()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id'       => $this->getId(),
            'title'    => $this->getTitle(),
            'createdAt'  => $this->getCreatedAt()->format("Y-m-d H:i:s"),
            'isActive' => $this->getIsActive()
        ];
    }
}
