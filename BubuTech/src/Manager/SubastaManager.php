<?php
    namespace App\Manager;
    
    use App\Repository\SubastaRepository;
    use App\Entity\Subasta;
    use App\Entity\Producto;
    use App\Entity\Usuario;
    use App\Enum\EstadoSubasta;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class SubastaManager {

        private SubastaRepository $repositorio;
        private OfertaManager $ofertaManager;
        private EntityManagerInterface $em;

        function __construct(SubastaRepository $repository, EntityManagerInterface $em) {
            $this->repositorio=$repository;
            $this->em=$em;
        }
        public function getSubastas() {
           return $this->repositorio->findAll();
        }
        public function publicarSubasta(Request $request): Subasta {
            $datos = $request->request->all();
            $imagen = $request->files->get('producto_imagen');

            $producto = new Producto();
            $producto->setNombre($datos['producto_nombre']);
            $producto->setDescripcion($datos['producto_descripcion']);

            if ($imagen) {
                $nuevoNombre = uniqid() . '.' . $imagen->guessExtension();
                $imagen->move(__DIR__ . '/../../public/uploads/productos', $nuevoNombre);
                $producto->setImagen($nuevoNombre);
            }

            $subasta = new Subasta();
            $subasta->setProducto($producto);
            $subasta->setPrecioBase((float)$datos['precio_base']);
            $subasta->setDuracion(new \DateTime('+' . $datos['duracion'] . ' days'));
            $subasta->setCategoria($datos['categoria'] ?? null);
            $subasta->setEstado(EstadoSubasta::ACTIVA);
            $subasta->setOfertaParcialGanadora(0);
            $subasta->setOfertaFinalGanadora(0);

            $this->em->persist($producto);
            $this->em->persist($subasta);
            $this->em->flush();

            return $subasta;
        }
        public function getSubastasGanadasPorUsuario(\App\Entity\Usuario $usuario, \App\Repository\OfertaRepository $ofertaRepository): array
        {
            $subastas = $this->getSubastas();
            $subastasGanadas = [];

            foreach ($subastas as $subasta) {
                $ofertaGanadora = $ofertaRepository->createQueryBuilder('o')
                    ->where('o.subasta = :subasta')
                    ->andWhere('o.Monto = :montoGanador')
                    ->setParameter('subasta', $subasta)
                    ->setParameter('montoGanador', $subasta->getOfertaFinalGanadora())
                    ->getQuery()
                    ->getOneOrNullResult();

                if ($ofertaGanadora && $ofertaGanadora->getOfertante()->getId() === $usuario->getId()) {
                    $subastasGanadas[] = $subasta;
                }
            }

            return $subastasGanadas;
        }
        public function getSubastasPorVendedor(Usuario $usuario): array
        {
            return $this->repositorio->findBy(['vendedor' => $usuario]);
        }     
   

        public function actualizarSubasta(Subasta $subasta, Request $request): Subasta
        {
            $datos = $request->request->all();
            $imagen = $request->files->get('producto_imagen');

            $producto = $subasta->getProducto();
            if (!$producto) {
                throw new \RuntimeException('La subasta no tiene producto asociado');
            }

            // Actualizar campos del producto
            if (isset($datos['producto_nombre'])) {
                $producto->setNombre(trim($datos['producto_nombre']));
            }
            if (isset($datos['producto_descripcion'])) {
                $producto->setDescripcion(trim($datos['producto_descripcion']));
            }

            // Imagen nueva
            if ($imagen) {
                $nuevoNombre = uniqid() . '.' . $imagen->guessExtension();
                $imagen->move(__DIR__ . '/../../public/uploads/productos', $nuevoNombre);
                $producto->setImagen($nuevoNombre);
            }

            // Actualizar campos de la subasta
            if (isset($datos['precio_base']) && is_numeric($datos['precio_base'])) {
                $subasta->setPrecioBase((float)$datos['precio_base']);
            }

            // Duración
            if (isset($datos['duracion']) && is_numeric($datos['duracion'])) {
                $subasta->setDuracion(new \DateTime('+' . (int)$datos['duracion'] . ' days'));
            }

            if (isset($datos['categoria'])) {
                $subasta->setCategoria(trim($datos['categoria']));
            }

            $this->em->persist($producto);
            $this->em->persist($subasta);
            $this->em->flush();

            return $subasta;
        }
    }
?>