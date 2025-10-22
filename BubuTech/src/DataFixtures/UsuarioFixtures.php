<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Usuario;
use DateTime;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsuarioFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher=$passwordHasher;
    }

    public function load(ObjectManager $manager ): void
    {
        for ($i = 1; $i<6; $i++) {
            $usuario = new Usuario();
            $usuario->setNombreUsuario("UsuarioTest".$i);
            $usuario->setRoles(["ROLE_VENDEDOR"]);
            $plainPassword="123";
            $usuario->setPassword($this->passwordHasher->hashPassword($usuario, $plainPassword));
            $usuario->setNombreReal("Usuario ".$i);
            $usuario->setApellido("Apellido ".$i);
            $usuario->setEmail("mailtest".$i."@gmail.com");
            $fechanacimiento = new DateTime("2025-".$i."-15");
            $usuario->setFechaNacimiento($fechanacimiento);
            $usuario->setDni($i*10000000);
            $usuario->setDireccion("Pasaje Nro ".$i);
            $manager->persist($usuario);
            $this->addReference('usuario_'.$i, $usuario);
        }
        for ($i = 6; $i<11; $i++) {
            $usuario = new Usuario();
            $usuario->setNombreUsuario("UsuarioTest".$i);
            $usuario->setRoles(["ROLE_COMPRADOR"]);
            $plainPassword="123";
            $usuario->setPassword($this->passwordHasher->hashPassword($usuario, $plainPassword));
            $usuario->setNombreReal("Usuario ".$i);
            $usuario->setApellido("Apellido ".$i);
            $usuario->setEmail("mailtest".$i."@gmail.com");
            $fechanacimiento = new DateTime("2025-".$i."-15");
            $usuario->setFechaNacimiento($fechanacimiento);
            $usuario->setDni($i*10000000);
            $usuario->setDireccion("Pasaje Nro ".$i);
            $manager->persist($usuario);
            $this->addReference('usuario_'.$i, $usuario);
        }
        $manager->flush();
    }
}