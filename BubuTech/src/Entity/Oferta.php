<?php

namespace App\Entity;

use App\Repository\OfertaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfertaRepository::class)]
class Oferta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $Monto = null;

    #[ORM\Column]
    private ?\DateTime $Fecha = null;

    #[ORM\ManyToOne(inversedBy: 'Ofertaa')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $ofertante = null;

    #[ORM\ManyToOne(inversedBy: 'Oferta')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subasta $subasta = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonto(): ?float
    {
        return $this->Monto;
    }

    public function setMonto(float $Monto): static
    {
        $this->Monto = $Monto;

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

    public function getOfertante(): ?Usuario
    {
        return $this->ofertante;
    }

    public function setOfertante(?Usuario $ofertante): static
    {
        $this->ofertante = $ofertante;

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
}
