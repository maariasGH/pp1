<?php
    namespace App\Manager;
    
    use App\Repository\ProductoRepository;

    class ProductoManager {

        private ProductoRepository $repositorio;

        function __construct(ProductoRepository $repository) {
            $this->repositorio=$repository;
        }
        public function getProductos() {
           return $this->repositorio->findAll();
        }     
    }
?>