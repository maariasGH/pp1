<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    
    class EstadisticaController extends AbstractController {
        
        #[Route('/estadisticas', name: 'ver_estadisticas')] // http://localhost/pp1/BubuTech/public
        
        public function verEstadisticas(): Response {
            return $this->render("Estadisticas/estadisticas.html.twig");
        }
    }
?>