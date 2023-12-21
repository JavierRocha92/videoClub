<?php
/**
 * Class to represent a pelicula object with parameters such us id,titulo,genero, pais, anyo, cartel ans actores array
 */
class Pelicula {
    /**
     * Id for any pelicula
     * 
     * @var number 
     */
    private $id;
    /**
     * Title for any pelicula
     * 
     * @var string 
     */
    private $titulo;
    /**
     * Genre for any pelicula
     * 
     * @var string
     */
    private $genero;
    /**
     * Creating country for any pelicula
     * 
     * @var string
     */
    private $pais;
    /**
     * Launch year for any pelicula
     * 
     * @var number
     */
    private $anyo;
    /**
     * Cartel image for any pelicula
     * 
     * @var string
     */
    private $cartel;
    /**
     * Actor object array for save cast for any pelicula
     * 
     * @var array
     */
    private array $actores = [];
    /**
     * Function to construct pelicula objest by taking parameter such us id, titulo, genero, pais, anyo, cartel asd actores
     * 
     * @param number $id
     * @param string $titulo
     * @param string $genero
     * @param string $pais
     * @param number $anyo
     * @param string $cartel
     * @param array $actores
     */
    public function __construct($id, $titulo, $genero, $pais, $anyo, $cartel, array $actores = []) {//El array se le debe declara como arrya de objetos de actores
        $this->id = $id;
        $this->titulo = $titulo;
        $this->genero = $genero;
        $this->pais = $pais;
        $this->anyo = $anyo;
        $this->cartel = $cartel;
        $this->actores = $actores;
    }
    /**
     * Function to get id from a pelicula
     * 
     * @return number
     */
    public function getId() {
        return $this->id;
    }
    /**
     * Function to get titulo from a pelicula
     * 
     * @return string
     */
    public function getTitulo() {
        return $this->titulo;
    }
    /**
     * Function to get genreo from a pelicula
     * 
     * @return string
     */
    public function getGenero() {
        return $this->genero;
    }
    /**
     * Function to get pais from a pelicula
     * 
     * @return string
     */
    public function getPais() {
        return $this->pais;
    }
    /**
     * Function to get anyo from a pelicula
     * 
     * @return number
     */
    public function getAnyo() {
        return $this->anyo;
    }
    /**
     * Function to get cartel from a pelicula
     * 
     * @return string
     */
    public function getCartel() {
        return $this->cartel;
    }
    /**
     * Function to set id value for any pelicula
     * 
     * @param number $id
     * @return id from a pelicula
     */
    public function setId($id): void {
        $this->id = $id;
    }
    /**
     * Function to set titulo value for any pelicula
     * 
     * @param string $titulo
     * @return titulo from a pelicula
     */
    public function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }
    /**
     * Function to set genero value for any pelicula
     * 
     * @param string $genero
     * @return genero from a pelicula
     */
    public function setGenero($genero): void {
        $this->genero = $genero;
    }
    /**
     * Function to set pais value for any pelicula
     * 
     * @param string $pais
     * @return pais from a pelicula
     */
    public function setPais($pais): void {
        $this->pais = $pais;
    }
    /**
     * Function to set anyo value for any pelicula
     * 
     * @param number $anyo
     * @return anyo from a pelicula
     */
    public function setAnyo($anyo): void {
        $this->anyo = $anyo;
    }
    /**
     * Function to set cartel value for any pelicula
     * 
     * @param string $cartel
     * @return cartel from a pelicula
     */
    public function setCartel($cartel): void {
        $this->cartel = $cartel;
    }
    /**
     * Function to set actores array  values for any pelicula
     * 
     * @return actores from a pelicula
     */
    public function getActores(): array {
        return $this->actores;
    }
    /**
     * Function to set actroes array values for any pelicula
     * 
     * @param string $actroes
     * @return actores from a pelicula
     */
    public function setActores(array $actors): void {
        $this->actores = $actors;
    }
    /**
     * Funtion to return a pelucula as format string 
     * 
     * @return string pelciula object show as string format
     */
    public function __toString() {
        return "Id => $this->id, titulo => $this->titulo, Genero => $this->genero, Pais => $this->pais, Anyo => $this->anyo, y la imagen => $this->cartel";
    }

    /**
     * function to add or push an actor into actors array by calling array_push mehtod
     * 
     * @param Array $actor actor object
     */
    public function addActor($actor) {
        array_push($this->actores, $actor);
    }
    /**
     * Function to display a pelicula information as card format
     * 
     * @param number $userRol rol from user is navigating pages
     */
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
                    <h2 class="card__title
                        <?php
                        //Constional to cntrol font size when title is larger than 12 characters
                        if(strlen($this->titulo) > 12){
                            echo 'fs-5';
                        }
                        ?>
                        ">
                        <?php echo $this->titulo ?>
                    </h2>
                    <!-- film info (year) (duration) (genre) -->
                    <div class="card__info d-flex justify-content-between col-10 mb-4">
                        <!-- film year launch -->
                        <span class="card__year">
                            <?= $this->getAnyo() ?>
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
                foreach ($this->actores as $actor) {
                    $actor->showAsCArd();
                }
                ?>
            </footer><!-- final footer card -->
            <?php
            //Conditional to check if rol is 1 
            if ($userRol == 1) {
                //Calling function to create button to modify
                createButtonsFilm($this);
            }
            ?>
        </article><!-- final container card -->
        <?php
    }
}
