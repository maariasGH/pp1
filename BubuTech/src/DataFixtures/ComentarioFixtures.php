<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Comentario;
use App\Entity\Usuario;
use App\Entity\Subasta;
use App\Manager\SubastaManager;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ComentarioFixtures extends Fixture implements DependentFixtureInterface
{
    private $subastas;

    public function __construct() {
        $this->subastas = array();
    }

    public function getDependencies(): array
    {
        return [
            SubastaFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $this->getDependencies();
        array_push($this->subastas,$this->getReference('subasta_teclado', Subasta::class));
        array_push($this->subastas,$this->getReference('subasta_grafica', Subasta::class));
        array_push($this->subastas,$this->getReference('subasta_mouse', Subasta::class));
        array_push($this->subastas,$this->getReference('subasta_microfono', Subasta::class));
        array_push($this->subastas,$this->getReference('subasta_procesador', Subasta::class));
        $usuarios = [];
        for ($i = 1; $i <= 10; $i++) {
            $usuarios[] = $this->getReference('usuario_'.$i,Usuario::class);
        }
        foreach ($this->subastas as $subasta ) {
            $comentador = $usuarios[array_rand($usuarios)];
            $comentario = new Comentario();
            $comentario->setDetalle('Muy facil de Ganar...');
            $comentario->setFecha(new \Datetime());
            $comentario->setCantidadLikes(0);
            $comentario->setComentador($comentador);
            $comentario->setSubasta($subasta);
            $manager->persist($comentario);
        }
        foreach ($this->subastas as $subasta ) {
            $comentador = $usuarios[array_rand($usuarios)];
            $comentario = new Comentario();
            $comentario->setDetalle('No vale la pena.');
            $comentario->setFecha(new \Datetime());
            $comentario->setCantidadLikes(0);
            $comentario->setComentador($comentador);
            $comentario->setSubasta($subasta);
            $manager->persist($comentario);
        }
        foreach ($this->subastas as $subasta ) {
            $comentador = $usuarios[array_rand($usuarios)];
            $comentario = new Comentario();
            $comentario->setDetalle('Yo lo quieroo 😎');
            $comentario->setFecha(new \Datetime());
            $comentario->setCantidadLikes(0);
            $comentario->setComentador($comentador);
            $comentario->setSubasta($subasta);
            $manager->persist($comentario);
        }
        foreach ($this->subastas as $subasta ) {
            $comentador = $usuarios[array_rand($usuarios)];
            $comentario = new Comentario();
            $comentario->setDetalle('Muy Caroo 😨');
            $comentario->setFecha(new \Datetime());
            $comentario->setCantidadLikes(0);
            $comentario->setComentador($comentador);
            $comentario->setSubasta($subasta);
            $manager->persist($comentario);
        }
        $manager->flush();
    }
}