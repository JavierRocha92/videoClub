<?php

class Pelicula {

    private $id;
    private $titulo;
    private $genero;
    private $pais;
    private $anyo;
    private $cartel;
    private array $actors;

    public function __construct($id, $titulo, $genero, $pais, $anyo, $cartel, array $actors = []) {//El array se le debe declara como arrya de objetos de actores
        $this->id = $id;
        $this->titulo = $titulo;
        $this->genero = $genero;
        $this->pais = $pais;
        $this->anyo = $anyo;
        $this->cartel = $cartel;
        $this->actors = $actors;
    }

//    public function __destruct() {
//        echo "La pelicula con el id $this->id ha sido eliminada";
//    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getPais() {
        return $this->pais;
    }

    public function getAnyo() {
        return $this->anyo;
    }

    public function getCartel() {
        return $this->cartel;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    public function setGenero($genero): void {
        $this->genero = $genero;
    }

    public function setPais($pais): void {
        $this->pais = $pais;
    }

    public function setAnyo($anyo): void {
        $this->anyo = $anyo;
    }

    public function setCartel($cartel): void {
        $this->cartel = $cartel;
    }

    public function getActors(): array {
        return $this->actors;
    }

    public function setActors(array $actors): void {
        $this->actors = $actors;
    }

    public function __toString() {
        return "Id => $this->id, titulo => $this->titulo, Genero => $this->genero, Pais => $this->pais, Anyo => $this->anyo, y la imagen => $this->cartel";
    }

    /**
     * function to add or push an actor into actors array by calling array_push mehtod
     * 
     * @param Array $actor
     */
    public function addActor($actor) {
        array_push($this->actors, $actor);
    }

    public function showAsCard() {
        ?>

        <div class="card mb-3">
            <div class="card__visor">
                <header class="card__header">
                    <h2 class="card__title"><?= $this->titulo ?></h2>
                    <h2 class="card__genre"><?= $this->genero ?></h2>
                </header>
                <div class="container__image">
                    <img class="visor__image" src="../assets/images/<?= $this->cartel ?>" alt="alt"/>
                </div>
            </div>
            <footer class="card__footer">
                <?php
                //For each to call all actor objecto from actors array 
                foreach ($this->actors as $actor) {
                    //Aqui hay que llamar al metodo de actor->showAsCard()
                    $actor->showAsCard();
                }
                ?>
            </footer>
            <?php
        }
    }
    