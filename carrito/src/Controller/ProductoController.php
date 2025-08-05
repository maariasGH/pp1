<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class ProductoController extends AbstractController {

        #[Route( '/', name: 'listar_productos')] 

        public function listarProductos() : Response {
            $html = '<html><body><b>Esta es la lista de productos</b></body></html>';
            return $this->render("producto/lista.html.twig");
        }
    } 

?>