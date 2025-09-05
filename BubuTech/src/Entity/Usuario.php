<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_NOMBRE_USUARIO', fields: ['NombreUsuario'])]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $NombreUsuario = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $NombreReal = null;

    #[ORM\Column(length: 20)]
    private ?string $Apellido = null;

    #[ORM\Column(length: 30)]
    private ?string $Email = null;

    #[ORM\Column]
    private ?\DateTime $FechaNacimiento = null;

    #[ORM\Column]
    private ?int $DNI = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Direccion = null;

    /**
     * @var Collection<int, Oferta>
     */
    #[ORM\OneToMany(targetEntity: Oferta::class, mappedBy: 'ofertante')]
    private Collection $Oferta;

    /**
     * @var Collection<int, Comentario>
     */
    #[ORM\OneToMany(targetEntity: Comentario::class, mappedBy: 'comentador', orphanRemoval: true)]
    private Collection $Comentario;

    public function __construct()
    {
        $this->Ofertaa = new ArrayCollection();
        $this->Comentario = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreUsuario(): ?string
    {
        return $this->NombreUsuario;
    }

    public function setNombreUsuario(string $NombreUsuario): static
    {
        $this->NombreUsuario = $NombreUsuario;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->NombreUsuario;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }

    public function getNombreReal(): ?string
    {
        return $this->NombreReal;
    }

    public function setNombreReal(string $NombreReal): static
    {
        $this->NombreReal = $NombreReal;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->Apellido;
    }

    public function setApellido(string $Apellido): static
    {
        $this->Apellido = $Apellido;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTime
    {
        return $this->FechaNacimiento;
    }

    public function setFechaNacimiento(\DateTime $FechaNacimiento): static
    {
        $this->FechaNacimiento = $FechaNacimiento;

        return $this;
    }

    public function getDNI(): ?int
    {
        return $this->DNI;
    }

    public function setDNI(int $DNI): static
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->Direccion;
    }

    public function setDireccion(?string $Direccion): static
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    /**
     * @return Collection<int, Oferta>
     */
    public function getOferta(): Collection
    {
        return $this->Oferta;
    }

    public function addOferta(Oferta $oferta): static
    {
        if (!$this->Oferta->contains($oferta)) {
            $this->Oferta->add($oferta);
            $oferta->setOfertante($this);
        }

        return $this;
    }

    public function removeOfertaa(Oferta $oferta): static
    {
        if ($this->Oferta->removeElement($oferta)) {
            // set the owning side to null (unless already changed)
            if ($oferta->getOfertante() === $this) {
                $oferta->setOfertante(null);
            }
        }

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
            $comentario->setComentador($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): static
    {
        if ($this->Comentario->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getComentador() === $this) {
                $comentario->setComentador(null);
            }
        }

        return $this;
    }
}
