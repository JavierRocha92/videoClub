<?php

class Actor {

    public $id;
    public $nombre;
    public $apellidos;
    public $fotografia;

    public function __construct($id, $nombre, $apellidos, $fotografia) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fotografia = $fotografia;
    }

//    public function __destruct() {
//        echo 'El actor con el id ' . $this->id . ' ha sido eliminado';
//    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getFotografia() {
        return $this->fotografia;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setFotografia($fotografia): void {
        $this->fotografia = $fotografia;
    }

    public function showAsCard() {
        ?>
        <!-- actor card -->
                <article class="actor position-relative col-3">
                    <!-- actor name -->
                    <p class="actor__name position-absolute">
                        <?php
                        echo $this->nombre;
                        ?>
                    </p>
                    <!-- actor avatar -->
                    <img src="../assets/images/actors/<?= $this->fotografia ?>" class="actor__avatar" alt="">
                </article>
        <?php
    }
}
