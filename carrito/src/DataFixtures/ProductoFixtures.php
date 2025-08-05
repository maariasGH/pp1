<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Producto;

class ProductoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0;$i<10;$i++) {
            $producto = new Producto();
            $producto->setNombre("Producto ".$i+1);
            $producto->setDescripcion("Lorem Impsum");
            $producto->setPrecio(rand(10,100));
            $producto->setImagen("images/producto".$i.".jpg");
            $manager->persist($producto);
        }
        $manager->flush();
    }
}
