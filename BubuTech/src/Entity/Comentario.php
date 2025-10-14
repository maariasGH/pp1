<?php

namespace App\Entity;

use App\Repository\ComentarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentarioRepository::class)]
class Comentario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 250)]
    private ?string $Detalle = null;

    #[ORM\Column]
    private ?\DateTime $Fecha = null;

    #[ORM\Column]
    private ?int $CantidadLikes = null;


     #[ORM\ManyToMany(targetEntity:Usuario::class, inversedBy:"comentariosMegusteados")]
     #[ORM\JoinTable(name:"comentario_usuario_megusta")]

    private $usuariosMeGusta;

    #[ORM\ManyToOne(inversedBy: 'Comentario')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $comentador = null;

    #[ORM\ManyToOne(inversedBy: 'Comentario')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subasta $subasta = null;

    public function __construct() {
        $this->UsuariosMeGusta = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetalle(): ?string
    {
        return $this->Detalle;
    }

    public function setDetalle(string $Detalle): static
    {
        $this->Detalle = $Detalle;

        return $this;
    }

    public function getFecha(): ?\DateTime
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTime $Fecha): static
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getCantidadLikes(): ?int
    {
        return $this->CantidadLikes;
    }

    public function setCantidadLikes(int $CantidadLikes): static
    {
        $this->CantidadLikes = $CantidadLikes;

        return $this;
    }

    public function getComentador(): ?Usuario
    {
        return $this->comentador;
    }

    public function setComentador(?Usuario $comentador): static
    {
        $this->comentador = $comentador;

        return $this;
    }

    public function getSubasta(): ?Subasta
    {
        return $this->subasta;
    }

    public function setSubasta(?Subasta $subasta): static
    {
        $this->subasta = $subasta;

        return $this;
    }
    /**
     * @return Collection<Usuario, Usuario>
     */
    public function getUsuariosMeGusta(): Collection
    {
        return $this->usuariosMeGusta;
    }

    public function addUsuariosMeGusta(Usuario $usuario): static
    {
        if (!$this->usuariosMeGusta->contains($usuario)) {
            $this->usuariosMeGusta->add($usuario);
        }

        return $this;
    }

    public function removeUsuariosMeGusta(Usuario $usuario): static
    {
        $this->usuariosMeGusta->removeElement($usuario);
        return $this;
    }
}
