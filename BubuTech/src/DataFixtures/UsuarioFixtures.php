<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Usuario;
use DateTime;

class UsuarioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $usuario = new Usuario();
        $usuario->setNombreUsuario("UsuarioTest");
        $usuario->setRoles(["Comprador"],["Vendedor"]);
        $usuario->setPassword('$2y$13$YxCBxcbf6kinUg.br//13uCMHO3t813LMAiNEmDPUfiDhrjSclVDW');
        $usuario->setNombreReal("Mateo Nicolas");
        $usuario->setApellido("Costa IES");
        $usuario->setEmail("mailtest@gmail.com");
        $fechanacimiento = new DateTime("2025-05-15");
        $usuario->setFechaNacimiento($fechanacimiento);
        $usuario->setDni(40123478);
        $usuario->setDireccion("Pasaje IES 123");
        $manager->persist($usuario);
        $manager->flush();
    }
}