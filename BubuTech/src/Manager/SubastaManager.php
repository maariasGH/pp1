<?php
    namespace App\Manager;
    
    use App\Repository\SubastaRepository;
    use App\Entity\Subasta;
    use App\Entity\Producto;
    use App\Enum\EstadoSubasta;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class SubastaManager {

        private SubastaRepository $repositorio;
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
    }
?>