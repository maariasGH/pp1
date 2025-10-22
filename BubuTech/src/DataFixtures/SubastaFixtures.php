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
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SubastaFixtures extends Fixture implements DependentFixtureInterface
{
     public function getDependencies(): array
    {
        return [
            UsuarioFixtures::class,
        ];
    }
    public function load(ObjectManager $manager): void
    {
        $this->getDependencies();
        $this->teclado($manager);
        $this->microfono($manager);
        $this->grafica($manager);
        $this->mouse($manager);
        $this->procesador($manager);
    }
    private function teclado(ObjectManager $manager): void {
        //producto
        $producto = new Producto();
        $producto->setNombre("Teclado Gamer - 60%");
        $producto->setDescripcion("Teclado Mecanico con RGB para disfrutar tus juegos al maximo");
        $producto->setImagen("teclado.jpg");     
        
        //subasta
        $subasta = new Subasta();
        $subasta->setProducto($producto);
        $vendedor= $this->getReference('usuario_1', Usuario::class);
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
        $ofertante1 = $this->getReference('usuario_2', Usuario::class);
        $oferta1->setOfertante($ofertante1);
        $oferta1->setFecha(new DateTime("2025-10-28"));
        $oferta1->setSubasta($subasta);
        $oferta2= new Oferta();
        $oferta2->setMonto(70000);
        $ofertante2 = $this->getReference('usuario_3', Usuario::class);
        $oferta2->setOfertante($ofertante2);
        $oferta2->setFecha(new DateTime("2025-10-28"));
        $oferta2->setSubasta($subasta);
        $oferta3= new Oferta();
        $oferta3->setMonto(80000);
        $ofertante3 = $this->getReference('usuario_4', Usuario::class);
        $oferta3->setOfertante($ofertante3);
        $oferta3->setFecha(new DateTime("2025-10-28"));
        $oferta3->setSubasta($subasta);

        $subasta->setOfertaParcialGanadora($oferta1->getMonto());
        $subasta->setOfertaParcialGanadora($oferta2->getMonto());
        $subasta->setOfertaParcialGanadora($oferta3->getMonto());
        $subasta->setOfertaFinalGanadora($oferta3->getMonto());

        $manager->persist($producto);
        $manager->persist($subasta);
        $manager->persist($oferta1);
        $manager->persist($oferta2);
        $manager->persist($oferta3);
        $this->addReference('subasta_teclado', $subasta);
        $manager->flush(); 
    }
    
    private function grafica(ObjectManager $manager): void {
        $producto2 = new Producto();
        $producto2->setNombre("Placa de Video RTX 3060");
        $producto2->setDescripcion("Gráfica potente para gaming en 1080p y edición de video fluida");
        $producto2->setImagen("Grafica.jpg");

        $subasta2 = new Subasta();
        $subasta2->setProducto($producto2);
        $subasta2->setVendedor($this->getReference('usuario_2', Usuario::class));
        $subasta2->setPrecioBase(240000);
        $subasta2->setDuracion(new \DateTime('+3 days'));
        $subasta2->setCategoria('Placa de Video');
        $subasta2->setEstado(EstadoSubasta::ACTIVA);
        $subasta2->setOfertaParcialGanadora(0);
        $subasta2->setOfertaFinalGanadora(0);

        $oferta21 = new Oferta();
        $oferta21->setMonto(245000);
        $oferta21->setOfertante($this->getReference('usuario_6', Usuario::class));
        $oferta21->setFecha(new DateTime("2025-10-28"));
        $oferta21->setSubasta($subasta2);

        $oferta22 = new Oferta();
        $oferta22->setMonto(252000);
        $oferta22->setOfertante($this->getReference('usuario_8', Usuario::class));
        $oferta22->setFecha(new DateTime("2025-10-28"));
        $oferta22->setSubasta($subasta2);

        $oferta23 = new Oferta();
        $oferta23->setMonto(260000);
        $oferta23->setOfertante($this->getReference('usuario_9', Usuario::class));
        $oferta23->setFecha(new DateTime("2025-10-28"));
        $oferta23->setSubasta($subasta2);

        $subasta2->setOfertaParcialGanadora($oferta21->getMonto());
        $subasta2->setOfertaParcialGanadora($oferta22->getMonto());
        $subasta2->setOfertaParcialGanadora($oferta23->getMonto());
        $subasta2->setOfertaFinalGanadora($oferta23->getMonto());

        $manager->persist($producto2);
        $manager->persist($subasta2);
        $manager->persist($oferta21);
        $manager->persist($oferta22);
        $manager->persist($oferta23);
        $this->addReference('subasta_grafica', $subasta2);
        $manager->flush(); 
    }
    
    private function mouse(ObjectManager $manager): void {
        $producto4 = new Producto();
        $producto4->setNombre("Mouse Gamer RGB");
        $producto4->setDescripcion("Sensor óptico de alta precisión y diseño ergonómico");
        $producto4->setImagen("Mouse.jpg");

        $subasta4 = new Subasta();
        $subasta4->setProducto($producto4);
        $subasta4->setVendedor($this->getReference('usuario_7', Usuario::class));
        $subasta4->setPrecioBase(30000);
        $subasta4->setDuracion(new \DateTime('+5 days'));
        $subasta4->setCategoria('Mouse');
        $subasta4->setEstado(EstadoSubasta::ACTIVA);
        $subasta4->setOfertaParcialGanadora(0);
        $subasta4->setOfertaFinalGanadora(0);

        $oferta41 = new Oferta();
        $oferta41->setMonto(31000);
        $oferta41->setOfertante($this->getReference('usuario_10', Usuario::class));
        $oferta41->setFecha(new DateTime("2025-10-28"));
        $oferta41->setSubasta($subasta4);

        $oferta42 = new Oferta();
        $oferta42->setMonto(32500);
        $oferta42->setOfertante($this->getReference('usuario_8', Usuario::class));
        $oferta42->setFecha(new DateTime("2025-10-28"));
        $oferta42->setSubasta($subasta4);

        $oferta43 = new Oferta();
        $oferta43->setMonto(34000);
        $oferta43->setOfertante($this->getReference('usuario_6', Usuario::class));
        $oferta43->setFecha(new DateTime("2025-10-28"));
        $oferta43->setSubasta($subasta4);

        $subasta4->setOfertaParcialGanadora($oferta41->getMonto());
        $subasta4->setOfertaParcialGanadora($oferta42->getMonto());
        $subasta4->setOfertaParcialGanadora($oferta43->getMonto());
        $subasta4->setOfertaFinalGanadora($oferta43->getMonto());

        $manager->persist($producto4);
        $manager->persist($subasta4);
        $manager->persist($oferta41);
        $manager->persist($oferta42);
        $manager->persist($oferta43);
        $this->addReference('subasta_mouse', $subasta4);
        $manager->flush();

    }
    
    private function microfono(ObjectManager $manager): void {
        $producto3 = new Producto();
        $producto3->setNombre("Micrófono Condensador USB");
        $producto3->setDescripcion("Ideal para streaming, podcast y videollamadas con calidad profesional");
        $producto3->setImagen("Microfono.jpg");

        $subasta3 = new Subasta();
        $subasta3->setProducto($producto3);
        $subasta3->setVendedor($this->getReference('usuario_10', Usuario::class));
        $subasta3->setPrecioBase(42000);
        $subasta3->setDuracion(new \DateTime('+5 days'));
        $subasta3->setCategoria('Micrófono');
        $subasta3->setEstado(EstadoSubasta::ACTIVA);
        $subasta3->setOfertaParcialGanadora(0);
        $subasta3->setOfertaFinalGanadora(0);

        $oferta31 = new Oferta();
        $oferta31->setMonto(43000);
        $oferta31->setOfertante($this->getReference('usuario_9', Usuario::class));
        $oferta31->setFecha(new DateTime("2025-10-28"));
        $oferta31->setSubasta($subasta3);

        $oferta32 = new Oferta();
        $oferta32->setMonto(44500);
        $oferta32->setOfertante($this->getReference('usuario_7', Usuario::class));
        $oferta32->setFecha(new DateTime("2025-10-28"));
        $oferta32->setSubasta($subasta3);

        $oferta33 = new Oferta();
        $oferta33->setMonto(46000);
        $oferta33->setOfertante($this->getReference('usuario_3', Usuario::class));
        $oferta33->setFecha(new DateTime("2025-10-28"));
        $oferta33->setSubasta($subasta3);

        $subasta3->setOfertaParcialGanadora($oferta31->getMonto());
        $subasta3->setOfertaParcialGanadora($oferta32->getMonto());
        $subasta3->setOfertaParcialGanadora($oferta33->getMonto());
        $subasta3->setOfertaFinalGanadora($oferta33->getMonto());

        $manager->persist($producto3);
        $manager->persist($subasta3);
        $manager->persist($oferta31);
        $manager->persist($oferta32);
        $manager->persist($oferta33);
        $this->addReference('subasta_microfono', $subasta3);
        $manager->flush();
    }
    
    private function procesador(ObjectManager $manager): void {
        $producto5 = new Producto();
        $producto5->setNombre("Procesador Ryzen 7 5800X");
        $producto5->setDescripcion("8 núcleos y 16 hilos para rendimiento extremo en multitarea");
        $producto5->setImagen("Procesador.jpg");

        $subasta5 = new Subasta();
        $subasta5->setProducto($producto5);
        $subasta5->setVendedor($this->getReference('usuario_5', Usuario::class));
        $subasta5->setPrecioBase(175000);
        $subasta5->setDuracion(new \DateTime('+5 days'));
        $subasta5->setCategoria('Procesador');
        $subasta5->setEstado(EstadoSubasta::ACTIVA);
        $subasta5->setOfertaParcialGanadora(0);
        $subasta5->setOfertaFinalGanadora(0);

        $oferta51 = new Oferta();
        $oferta51->setMonto(178000);
        $oferta51->setOfertante($this->getReference('usuario_2', Usuario::class));
        $oferta51->setFecha(new DateTime("2025-10-28"));
        $oferta51->setSubasta($subasta5);

        $oferta52 = new Oferta();
        $oferta52->setMonto(182000);
        $oferta52->setOfertante($this->getReference('usuario_1', Usuario::class));
        $oferta52->setFecha(new DateTime("2025-10-28"));
        $oferta52->setSubasta($subasta5);

        $oferta53 = new Oferta();
        $oferta53->setMonto(185500);
        $oferta53->setOfertante($this->getReference('usuario_9', Usuario::class));
        $oferta53->setFecha(new DateTime("2025-10-28"));
        $oferta53->setSubasta($subasta5);

        $subasta5->setOfertaParcialGanadora($oferta51->getMonto());
        $subasta5->setOfertaParcialGanadora($oferta52->getMonto());
        $subasta5->setOfertaParcialGanadora($oferta53->getMonto());
        $subasta5->setOfertaFinalGanadora($oferta53->getMonto());

        $manager->persist($producto5);
        $manager->persist($subasta5);
        $manager->persist($oferta51);
        $manager->persist($oferta52);
        $this->addReference('subasta_procesador', $subasta5);
        $manager->flush();
    }
}