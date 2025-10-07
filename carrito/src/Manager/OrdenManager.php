<?php
namespace App\Manager;

use App\Entity\Orden;
use App\Entity\Item;
use App\Repository\ProductoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class OrdenManager
{
    private EntityManagerInterface $entityManager;
    private ProductoRepository $productoRepository;

    public function __construct(EntityManagerInterface $entityManager, ProductoRepository $productoRepository)
    {
        $this->entityManager = $entityManager;
        $this->productoRepository = $productoRepository;
    }

    public function agregarProducto($usuario, int $idProducto, int $cantidad, Orden $orden): void
    {
        $producto = $this->productoRepository->find($idProducto);
        if (!$producto) {
            throw new \Exception("Producto no encontrado (ID: $idProducto)");
        }

        $item= new Item();
        $item->setProducto($producto);
        $item->setCantidad($cantidad);
        
        if ($orden) {
            $item->setOrden($orden);
        
            $orden->addItem($item);

            $this->entityManager->persist($item);
            $this->entityManager->persist($orden);
            $this->entityManager->flush();
        } else {
            $orden = new Orden();
            $orden->setEstado('Iniciada');
            $orden->setIniciada(new \DateTime());
            $orden->setUsuario($usuario);
            $item->setOrden($orden);
            
            $orden->addItem($item);

            $this->entityManager->persist($item);
            $this->entityManager->persist($orden);
            $this->entityManager->flush();
        }
        
    }

    public function getOrdenes()
    {
        return $this->entityManager->getRepository(Orden::class)->findAll();
    }

    public function getOrden(int $id): ?Orden
    {
        return $this->entityManager->getRepository(Orden::class)->find($id);
    }
}
