<?php

namespace App\Entity;

use App\Repository\FilesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilesRepository::class)]
class Files
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $pathFile = null;

    #[ORM\Column(length: 255)]
    private ?string $extensionFile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPathFile(): ?string
    {
        return $this->pathFile;
    }

    public function setPathFile(string $pathFile): self
    {
        $this->pathFile = $pathFile;

        return $this;
    }

    public function getExtensionFile(): ?string
    {
        return $this->extensionFile;
    }

    public function setExtensionFile(string $extensionFile): self
    {
        $this->extensionFile = $extensionFile;

        return $this;
    }
}
