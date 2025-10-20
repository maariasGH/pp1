<?php

namespace App\Entity;

use App\Entity\Usuario;
use App\Enum\EstadoSubasta;
use App\Repository\SubastaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubastaRepository::class)]
class Subasta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $OfertaParcialGanadora = null;

    #[ORM\Column]
    private ?float $OfertaFinalGanadora = null;

    #[ORM\Column]
    private ?\DateTime $Duracion = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $Categoria = null;

    #[ORM\Column]
    private ?float $PrecioBase = null;

    #[ORM\Column(enumType: EstadoSubasta::class)]
    private ?EstadoSubasta $Estado = null;

    /**
     * @var Collection<int, Oferta>
     */
    #[ORM\OneToMany(targetEntity: Oferta::class, mappedBy: 'subasta', orphanRemoval: true)]
    private Collection $Oferta;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Producto $producto = null;

    /**
     * @var Collection<int, Comentario>
     */
    #[ORM\OneToMany(targetEntity: Comentario::class, mappedBy: 'subasta', orphanRemoval: true)]
    private Collection $Comentario;

    
    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(nullable: false)] // si quieres que sea obligatorio
    private ?Usuario $vendedor = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(nullable: true)] // si quieres que sea obligatorio
    private ?Usuario $ganador = null;

    public function __construct()
    {
        $this->Oferta = new ArrayCollection();
        $this->Comentario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfertaParcialGanadora(): ?float
    {
        return $this->OfertaParcialGanadora;
    }

    public function setOfertaParcialGanadora(float $OfertaParcialGanadora): static
    {
        $this->OfertaParcialGanadora = $OfertaParcialGanadora;

        return $this;
    }

    public function getOfertaFinalGanadora(): ?float
    {
        return $this->OfertaFinalGanadora;
    }

    public function setOfertaFinalGanadora(float $OfertaFinalGanadora): static
    {
        $this->OfertaFinalGanadora = $OfertaFinalGanadora;

        return $this;
    }

    public function getDuracion(): ?\DateTime
    {
        return $this->Duracion;
    }

    public function setDuracion(\DateTime $Duracion): static
    {
        $this->Duracion = $Duracion;

        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->Categoria;
    }

    public function setCategoria(?string $Categoria): static
    {
        $this->Categoria = $Categoria;

        return $this;
    }

    public function getPrecioBase(): ?float
    {
        return $this->PrecioBase;
    }

    public function setPrecioBase(float $PrecioBase): static
    {
        $this->PrecioBase = $PrecioBase;

        return $this;
    }

    public function getEstado(): ?EstadoSubasta
    {
        return $this->Estado;
    }

    public function setEstado(EstadoSubasta $Estado): static
    {
        $this->Estado = $Estado;

        return $this;
    }

    /**
     * @return Collection<int, Oferta>
     */
    public function getOferta(): Collection
    {
        return $this->Oferta;
    }

    public function addOfertum(Oferta $ofertum): static
    {
        if (!$this->Oferta->contains($ofertum)) {
            $this->Oferta->add($ofertum);
            $ofertum->setSubasta($this);
        }

        return $this;
    }

    public function removeOfertum(Oferta $ofertum): static
    {
        if ($this->Oferta->removeElement($ofertum)) {
            // set the owning side to null (unless already changed)
            if ($ofertum->getSubasta() === $this) {
                $ofertum->setSubasta(null);
            }
        }

        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(Producto $producto): static
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * @return Collection<int, Comentario>
     */
    public function getComentario(): Collection
    {
        return $this->Comentario;
    }

    public function addComentario(Comentario $comentario): static
    {
        if (!$this->Comentario->contains($comentario)) {
            $this->Comentario->add($comentario);
            $comentario->setSubasta($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): static
    {
        if ($this->Comentario->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getSubasta() === $this) {
                $comentario->setSubasta(null);
            }
        }

        return $this;
    }

    public function getVendedor(): ?Usuario
    {
        return $this->vendedor;
    }

    public function setVendedor(?Usuario $vendedor): static
    {
        $this->vendedor = $vendedor;
        return $this;
    }

    public function getGanador(): ?Usuario
    {
        return $this->ganador;
    }

    public function setGanador(?Usuario $ganador): static
    {
        $this->ganador = $ganador;
        return $this;
    }
}
