<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Usuario;

class UsuarioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        for ($i=0;$i<10;$i++) {
            $usuario = new Usuario();
            $usuario->setNombre("Usuario ".$i+1);
            $usuario->setEmail("Usuario".($i+1)."@gmail.com");
            $usuario->setPassword('$2y$13$jHpFmkYuG2aSgoZa/6vOLuymLay/ebrebHCCt8saQyxaiLkROedD2');
            $manager->persist($usuario);
        }
        $manager->flush();
    }
}