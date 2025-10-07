<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Manager\OrdenManager;
use App\Repository\OrdenRepository;

class OrdenController extends AbstractController
{
    private OrdenManager $ordenManager;

    public function __construct(OrdenManager $ordenManager)
    {
        $this->ordenManager = $ordenManager;
    }

    #[Route('/orden/agregar', name: 'agregar_producto', methods: ['POST'])]
    public function agregarProducto(Request $request, OrdenRepository $ordenRepository): Response
    {
        $idProducto = $request->request->get('idProducto');
        $cantidad = $request->request->get('cantidad');
        $usuario = $this->getUser();
        $orden = $ordenRepository->findOneBy([
            'usuario' => $usuario,
            'estado' => 'iniciada',
        ]);
        

        $this->ordenManager->agregarProducto($usuario, (int)$idProducto, (int)$cantidad,  $orden);

        $this->addFlash(
            'Registrado',
            "Se ingresaron {$cantidad} unidades del producto {$idProducto} a la orden."
        );

        return $this->redirectToRoute('listar_productos');
    }
    #[Route('/orden/ver', name: 'ver_orden', methods: ['GET'])]
    public function verOrden(OrdenManager $ordenManager): Response {
        $usuario=$this->getUser();
        if (!$usuario) {
            return $this->redirectToRoute('app_login'); 
        }
        $orden= $ordenManager->getOrden($usuario->getId());
        return $this->render('orden/orden.html.twig', ['orden'=>$orden,]);
    }
}
