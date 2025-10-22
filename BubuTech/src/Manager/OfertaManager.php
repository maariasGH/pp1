<?php

namespace App\Manager;

use App\Entity\Oferta;
use App\Entity\Subasta;
use App\Repository\OfertaRepository;
use App\Enum\EstadoSubasta;

class OfertaManager
{
    private OfertaRepository $ofertaRepository;

    public function __construct(OfertaRepository $ofertaRepository)
    {
        $this->ofertaRepository = $ofertaRepository;
    }

    /**
     * Devuelve la oferta con mayor monto de una subasta
     */
    public function getOfertaMaxima(Subasta $subasta): ?Oferta
    {
        return $this->ofertaRepository->createQueryBuilder('o')
            ->where('o.subasta = :subasta')
            ->setParameter('subasta', $subasta)
            ->orderBy('o.Monto', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Devuelve la oferta con mayor monto entre las subastas finalizadas del vendedor
     * Útil para la estadística del vendedor
     */
    public function getOfertaMaximaDeSubastas(array $subastas): ?Oferta
    {
        if (empty($subastas)) {
            return null;
        }

        return $this->ofertaRepository->createQueryBuilder('o')
            ->join('o.subasta', 's')
            ->where('s IN (:subastas)')
            ->andWhere('s.Estado = :Estado')
            ->setParameter('subastas', $subastas)
            ->setParameter('Estado', EstadoSubasta::FINALIZADA)
            ->orderBy('o.Monto', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
