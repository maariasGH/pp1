<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Subasta;
use App\Entity\Oferta;
use App\Entity\Producto;
use App\Entity\Usuario;
use App\Manager\EntityManagerInterface;
use App\Enum\EstadoSubasta;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;

class SubastaFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        
        //producto
        $producto = new Producto();
        $producto->setNombre("Teclado Gamer - 60%");
        $producto->setDescripcion("Teclado Mecanico con RGB para disfrutar tus juegos al maximo");
        $producto->setImagen("teclado.jpg");     
        
        //subasta
        $subasta = new Subasta();
        $subasta->setProducto($producto);
        $vendedor=$manager->getRepository(Usuario::class)-> find(20);
        $subasta->setVendedor($vendedor);
        $subasta->setPrecioBase(53000);
        $subasta->setDuracion(new \DateTime('+' . 5 . ' days'));
        $subasta->setCategoria('Teclado');
        $subasta->setEstado(EstadoSubasta::ACTIVA);
        $subasta->setOfertaParcialGanadora(0);
        $subasta->setOfertaFinalGanadora(0);

        //ofertas
        $oferta1= new Oferta();
        $oferta1->setMonto(60000);
        $ofertante1=$manager->getRepository(Usuario::class)-> find(21);
        $oferta1->setOfertante($ofertante1);
        $oferta1->setFecha(new DateTime("2025-10-28"));
        $oferta1->setSubasta($subasta);
        $oferta2= new Oferta();
        $oferta2->setMonto(70000);
        $ofertante2=$manager->getRepository(Usuario::class)-> find(22);
        $oferta2->setOfertante($ofertante2);
        $oferta2->setFecha(new DateTime("2025-10-28"));
        $oferta2->setSubasta($subasta);
        $oferta3= new Oferta();
        $oferta3->setMonto(80000);
        $ofertante3=$manager->getRepository(Usuario::class)-> find(23);
        $oferta3->setOfertante($ofertante3);
        $oferta3->setFecha(new DateTime("2025-10-28"));
        $oferta3->setSubasta($subasta);

        $subasta->setOfertaParcialGanadora($oferta1->getMonto());
        $subasta->setOfertaFinalGanadora($oferta1->getMonto());
        $subasta->setOfertaParcialGanadora($oferta2->getMonto());
        $subasta->setOfertaFinalGanadora($oferta2->getMonto());
        $subasta->setOfertaParcialGanadora($oferta3->getMonto());
        $subasta->setOfertaFinalGanadora($oferta3->getMonto());

        $manager->persist($producto);
        $manager->persist($subasta);
        $manager->persist($oferta1);
        $manager->persist($oferta2);
        $manager->persist($oferta3);
        $manager->flush();

        
    }
}