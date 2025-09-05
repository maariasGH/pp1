<?php
 namespace App\Controller;
 
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;
 use App\Entity\Usuario;
 
 class UsuarioController extends AbstractController
 {

     #[Route('/perfil', name: 'perfil_usuario', methods: ['GET'])]
    public function mostrarPerfil(): Response
    {
        $usuario = $this->getUser(); // 👈 obtiene el usuario logueado

        if (!$usuario) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('Perfil/perfil.html.twig', [
            'usuario' => $usuario,
        ]);
    }
 }
?> 
