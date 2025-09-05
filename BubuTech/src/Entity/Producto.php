<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 150)]
    private ?string $Descripcion = null;

    #[ORM\Column(length: 100)]
    private ?string $Imagen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): static
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->Imagen;
    }

    public function setImagen(string $Imagen): static
    {
        $this->Imagen = $Imagen;

        return $this;
    }
}
