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
    public function comprador(
        SubastaManager $subastaManager,
        OfertaManager $ofertaManager
    ): Response {
        /** @var Usuario $usuario */
        $usuario = $this->getUser();

        
        $subastas = $subastaManager->getSubastas();

        $subastasGanadas = [];

        foreach ($subastas as $subasta) {
            // Obtenemos la oferta máxima de la subasta
            $ofertaGanadora = $ofertaManager->getOfertaMaxima($subasta);

            // Si el usuario actual es el ofertante ganador, agregamos la subasta
            if ($ofertaGanadora && $ofertaGanadora->getOfertante()->getId() === $usuario->getId()) {
                $subastasGanadas[] = $subasta;
            }
        }

        // Total gastado
        $totalGastado = array_reduce(
            $subastasGanadas,
            fn($carry, $subasta) => $carry + $subasta->getOfertaFinalGanadora(),
            0
        );

        // Subasta más cara
        $subastaMasCara = null;
        if (!empty($subastasGanadas)) {
            usort(
                $subastasGanadas,
                fn($a, $b) => $b->getOfertaFinalGanadora() <=> $a->getOfertaFinalGanadora()
            );
            $subastaMasCara = $subastasGanadas[0];
        } else {
            $this->addFlash('info','Aun no tienes subastas ganadas');
        }

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
        $totalGanado = array_reduce($subastas, fn($carry, $subasta) => $carry + ($subasta->getOfertaFinalGanadora() ?? 0), 0);

        // Oferta máxima entre todas las subastas
        $ofertaMaxima = $ofertaManager->getOfertaMaximaDeSubastas($subastas);

        return $this->render('Estadisticas/vendedor.html.twig', [
            'subastas' => $subastas,
            'totalGanado' => $totalGanado,
            'ofertaMaxima' => $ofertaMaxima,
        ]);
    }
}
