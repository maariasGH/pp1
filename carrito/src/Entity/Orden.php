<?php

namespace App\Entity;

use App\Repository\OrdenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdenRepository::class)]
class Orden
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $estado = null;

    #[ORM\Column]
    private ?\DateTime $iniciada = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $confirmada = null;

    /**
     * @var Collection<int, Item>
     */
    #[ORM\OneToMany(targetEntity: Item::class, mappedBy: 'orden')]
    private Collection $item;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    public function __construct()
    {
        $this->item = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIniciada(): ?\DateTime
    {
        return $this->iniciada;
    }

    public function setIniciada(\DateTime $iniciada): static
    {
        $this->iniciada = $iniciada;

        return $this;
    }

    public function getConfirmada(): ?\DateTime
    {
        return $this->confirmada;
    }

    public function setConfirmada(?\DateTime $confirmada): static
    {
        $this->confirmada = $confirmada;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Item $item): static
    {
        foreach ($item as $i) {
            if ($this->$item.equals($item)) {
                $this->item->add($item);
                $item->setOrden($this);
            }    
        }
        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->item->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getOrden() === $this) {
                $item->setOrden(null);
            }
        }

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

}
