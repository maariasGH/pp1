<?php
namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RecuperacionController extends AbstractController
{
    #[Route('/recuperar', name: 'app_recuperar')]
    public function recuperar(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
            $pin = $request->request->get('pin');
            $nueva = $request->request->get('nueva');
            $confirmar = $request->request->get('confirmar');
            $username = $request->request->get('username');

            // Validar que el PIN tenga 4 dígitos (No implementamos el envio a email por optimización, asi que el pin puede ser cualquiera que tenga 4 numeros)
            if (!preg_match('/^\d{4}$/', $pin)) {
                $this->addFlash('error', 'El PIN debe tener 4 dígitos.');
            } elseif ($nueva !== $confirmar) {
                $this->addFlash('error', 'Las contraseñas no coinciden.');
            } else {
                // Buscamos el usuario por el username
                $usuario = $em->getRepository(Usuario::class)->findOneBy(['NombreUsuario' => $username]);

                if (!$usuario) {
                    $this->addFlash('error', 'No se encontró ningún usuario.');
                } else {
                    $usuario->setPassword($passwordHasher->hashPassword($usuario, $nueva));
                    $em->flush();
                    $this->addFlash('success', 'Contraseña actualizada correctamente.');
                    return $this->redirectToRoute('app_login');
                }
            }
        }

        return $this->render('security/recuperar.html.twig');
    }
}