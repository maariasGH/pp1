<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Repository\OfertaRepository;
use App\Repository\SubastaRepository;
use App\Manager\SubastaManager;
use App\Manager\OfertaManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/estadisticas')]
#[IsGranted('ROLE_USER')]
class EstadisticaController extends AbstractController
{
    #[Route('/estadisticas_general', name: 'ver_estadisticas')]
    public function index(): Response
    {
        return $this->render('Estadisticas/general.html.twig');
    }

    #[Route('/comprador', name: 'estadisticas_comprador')]
    public function comprador(): Response {
        /** @var Usuario $usuario */
        $usuario = $this->getUser();
        // Cantidad de Subastas Ganadas
        $subastasGanadas= $usuario->getCantidadSubastasGanadas();
        // Subasta más cara
        $subastaMasCara = $usuario->getSubastaMasCara();
        //Total Gastado por el usuario
        $totalGastado = $usuario->getDineroGastado();

        return $this->render('Estadisticas/comprador.html.twig', [
            'subastasGanadas' => $subastasGanadas,
            'totalGastado' => $totalGastado,
            'subastaMasCara' => $subastaMasCara,
        ]);
    }



    #[Route('/vendedor', name: 'estadisticas_vendedor')]
    public function vendedor(
        SubastaManager $subastaManager,
        OfertaManager $ofertaManager
    ): Response {
        /** @var Usuario $usuario */
        $usuario = $this->getUser();

        // Subastas del vendedor
        $subastas = $subastaManager->getSubastasPorVendedor($usuario);

        // Total ganado
        $totalGanado = $usuario->getDineroGanado();

        // Oferta máxima entre todas las subastas
        $ofertaMaxima = $ofertaManager->getOfertaMaximaDeSubastas($subastas);

        return $this->render('Estadisticas/vendedor.html.twig', [
            'subastas' => $subastas,
            'totalGanado' => $totalGanado,
            'ofertaMaxima' => $ofertaMaxima,
        ]);
    }
}
