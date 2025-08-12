<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Repository\ProductoRepository;

    class ProductoController extends AbstractController {

        #[Route( '/', name: 'listar_productos')] 

        public function listarProductos(ProductoRepository $repository) : Response {
            $html = '<html><body><b>Esta es la lista de productos</b></body></html>';
            $productos = $repository->findAll(); 
            return $this->render("producto/lista.html.twig",  ['productos' => $productos]);
        }
    } 

?>