<?php
// src/Controller/RegisterController.php
namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController {
    #[Route('/registro', name: 'app_registro')]
    public function mostrarRegistro(): Response {
      return $this->render('security/registro.html.twig');
    }

    #[Route('/confirmar_registro', name: 'app_confirmar_registro', methods: ['POST'])]
    public function confirmarRegistro(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response {
        if ($request->isMethod('POST')) {
            $usuario = new Usuario();

            $usuario->setNombreUsuario($request->request->get('username'));
            $usuario->setNombreReal($request->request->get('nombre_real'));
            $usuario->setApellido($request->request->get('apellido'));
            $usuario->setEmail($request->request->get('email'));

            // Parsear fecha
            $fechaNacimientoStr = $request->request->get('fecha_nacimiento');
            if ($fechaNacimientoStr) {
                $fechaNacimiento = \DateTime::createFromFormat('Y-m-d', $fechaNacimientoStr);
                if ($fechaNacimiento !== false) {
                    $usuario->setFechaNacimiento($fechaNacimiento);
                }
            }

            $usuario->setDni((int)$request->request->get('dni'));
            $usuario->setDireccion($request->request->get('direccion'));

            $rolesSeleccionados = $request->request->all('roles'); // devuelve array
            if (!empty($rolesSeleccionados)) {
                $usuario->setRoles($rolesSeleccionados);
            } else {
                $usuario->setRoles(['ROLE_USER']); // fallback
            }
            // Contraseña hasheada
            $plainPassword = $request->request->get('password');
            if (!empty($plainPassword)) {
                $hashedPassword = $passwordHasher->hashPassword($usuario, $plainPassword);
                $usuario->setPassword($hashedPassword);
            }

            try {
                $em->persist($usuario);
                $em->flush();
                $this->addFlash('success', 'Cuenta creada con éxito. Ahora podés iniciar sesión.');

                return $this->redirectToRoute('app_login');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al registrar: '.$e->getMessage());
                return $this->redirectToRoute('app_registro');
            }    
        }
    }
}