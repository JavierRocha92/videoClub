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

    public function showAsCard($userRol) {
        ?>
        <!-- card container -->
        <article class="container__card mb-3 row d-flex justify-content-center">
            <!-- card content -->
            <article class="card flex-row border-0">
                <header class="card__header">
                    <img src="../assets/images/films/<?= $this->cartel ?>" alt="" class="card__img">
                </header>
                <!-- card main -->
                <main class="card__main p-3 text-light bg-dark col-7">
                    <!-- film title -->
                    <h2 class="card__title">
                        <?php echo $this->titulo ?>
                    </h2>
                    <!-- film info (year) (duration) (genre) -->
                    <div class="card__info d-flex justify-content-between col-10 mb-4">
                        <!-- film year launch -->
                        <span class="card__year">
                            2002
                        </span>
                        <!-- film duration -->
                        <span class="card__duration">
                            111 min
                        </span>
                        <!-- film genre -->
                        <span class="card__genre">
                            <?php echo $this->genero ?>
                        </span>
                    </div>
                    <!-- film raitng 'container star' -->
                    <div class="card__rating d-flex col-10 mb-4">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <div class="card__sinopsis col-12 mb-2">
                        <!-- film description -->
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi similique commodi placeat, at
                        amet velit, adipisci libero repudiandae vel vitae nulla tempore veritatis nihil maiores tempora
                        aliquid quia aperiam neque.
                    </div>
                    <!-- card button trailer -->
                    <div class="card__button ms-2 mb-0 position-relative col-7 d-flex row">
                        <a href="#" class="card__link text-decoration-none p-1 pe-2 fw-bold">
                            Watch Trailer</a>
                        <i class="fa-solid fs-4 fa-play card__icon position-absolute"></i>
                    </div>
                </main><!-- final card main -->
            </article><!-- final card content -->
            <!-- card footer -->
            <footer class="card__footer p-1 bg-dark row">
                <?php
                foreach ($this->actors as $actor) {
                    $actor->showAsCArd();
                }
                ?>
            </footer><!-- final footer card -->
            <?php
            //Conditional to check if rol is 1 
            if ($userRol == 1) {
                //Calling function to create button to modify
                createButtonsFilm($this->getId());
            }
            ?>
        </article><!-- final container card -->
        <?php
    }
}
