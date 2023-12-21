<?php
/**
 * Class to represent an actor object with parameters such us id,nombre,apellidos and fotografia
 */
class Actor {
    /**
     * 
     * @var number id for any actor
     */
    public $id;
    /**
     * 
     * @var string name for ay actor
     */
    public $nombre;
    /**
     * 
     * @var string surname for any actor
     */
    public $apellidos;
    /**
     * 
     * @var string photography for any actor
     */
    public $fotografia;

    /**
     * function to construct any actor by pass all these parameters as follow
     * 
     * @param number $id
     * @param string $nombre
     * @param string $apellidos
     * @param string $fotografia
     */
    public function __construct($id, $nombre, $apellidos, $fotografia) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fotografia = $fotografia;
    }
    /**
     * Fucntion to get id from an actor
     * 
     * @return number id from an actor
     */
    public function getId() {
        return $this->id;
    }
    /**
     * Fucntion to get nombre from an actor
     * 
     * @return string nombre from an actor
     */
    public function getNombre() {
        return $this->nombre;
    }
    /**
     * Fucntion to get apellidos from an actor
     * 
     * @return string apellidos from an actor
     */
    public function getApellidos() {
        return $this->apellidos;
    }
    /**
     * Fucntion to get fotografia from an actor
     * 
     * @return string fotografia from an actor
     */
    public function getFotografia() {
        return $this->fotografia;
    }
    /**
     * Function to set id value passed as parameters for any actor
     * 
     * @param number $id
     * @return number id from actor 
     */
    public function setId($id): void {
        $this->id = $id;
    }
    /**
     * Function to set nombre value passed as parameters for any actor
     * 
     * @param string $nombre
     * @return string nombre from actor 
     */
    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }
    /**
     * Function to set apellidos value passed as parameters for any actor
     * 
     * @param string $apellidos
     * @return string apellidos from actor 
     */
    public function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }
    /**
     * Function to set fotografia value passed as parameters for any actor
     * 
     * @param string $fotografia
     * @return string fotofrafia from actor 
     */
    public function setFotografia($fotografia): void {
        $this->fotografia = $fotografia;
    }
    /**
     * Function to display actor information in card format
     */
    public function showAsCard() {
        ?>
        <!-- actor card -->
                <article class="actor d-flex flex-column col-3">
                    <!-- actor name -->
                    <p class="actor__name fw-bold p-0 m-0 text-center text-light">
                        <?php
                        echo $this->nombre.' '.$this->apellidos;
                        ?>
                    </p>
                    <!-- actor avatar -->
                    <img src="../assets/images/actors/<?= $this->fotografia ?>" class="actor__avatar" alt="">
                </article>
        <?php
    }
}
