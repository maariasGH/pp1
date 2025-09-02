<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Manager\ProductoManager;


    class ProductoController extends AbstractController {

        #[Route( '/', name: 'listar_productos')] 


        public function listarProductos(ProductoManager $manager) : Response {
            $html = '<html><body><b>Esta es la lista de productos</b></body></html>';
            $productos = $manager->getProductos(); 
            return $this->render("producto/lista.html.twig",  ['productos' => $productos]);
        }
    } 

?>