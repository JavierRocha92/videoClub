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
        <div class="actor">
            <h3 class="actor__title fs-5"><?= $this->nombre . ' ' . $this->apellidos ?></h3>
            <div class="actor__container_image">
                <img class="actor__image" src="../assets/images/<?= $this->fotografia ?>" alt="alt"/>
            </div>
        </div>

        <?php
    }
}
