<?php
/**
 * Class to represent a usuario object builded by parameters such us id, username, password and rol
 */
class Usuario{
    /**
     * Id for any usuario
     * 
     * @var number
     */
    private $id;
    /**
     * Username for any usuario
     * 
     * @var string
     */
    private $username;
    /**
     * Password for any usuario
     * 
     * @var string
     */
    private $password;
    /**
     * Rol for any usuario
     * 
     * @var number
     */
    private $rol;
    /**
     * Function to construct an usuario object by taking parameter as follow
     * 
     * @param number $id
     * @param string $username
     * @param string $password
     * @param number $rol
     */
    public function __construct($id,$username,$password,$rol){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->rol = $rol;
    }
    /**
     * Function to get id from a usuario object
     * 
     * @return number id from any usuario
     */
    public function getId() {
        return $this->id;
    }
    /**
     * Function to get username from a usuario object
     * 
     * @return string username from any usuario
     */
    public function getUsername() {
        return $this->username;
    }
    /**
     * Function to get password from a usuario object
     * 
     * @return string pasword from any usuario
     */
    public function getPassword() {
        return $this->password;
    }
    /**
     * Function to get rol from a usuario object
     * 
     * @return number rol from any usuario
     */
    public function getRol() {
        return $this->rol;
    }
    /**
     * Function to set id value for any user by taking value given as parameter
     * 
     * @param number $id value given as parameter
     * @return number id from any usuario
     */
    public function setId($id): void {
        $this->id = $id;
    }
    /**
     * Function to set username value for any user by taking value given as parameter
     * 
     * @param string $username value given as parameter
     * @return string username from any usuario
     */
    public function setUsername($username): void {
        $this->username = $username;
    }
    /**
     * Function to set password value for any user by taking value given as parameter
     * 
     * @param string $password value given as parameter
     * @return string password from any usuario
     */
    public function setPassword($password): void {
        $this->password = $password;
    }
    /**
     * Function to set rol value for any user by taking value given as parameter
     * 
     * @param number $rol value given as parameter
     * @return number rol from any usuario
     */
    public function setRol($rol): void {
        $this->rol = $rol;
    }
    /**
     * Function to displat an usuario object information in a card format
     */
    public function showAsCard(){
        ?>
        <!-- card container -->
        <article class="container__card mb-3 row d-flex justify-content-center">
            <!-- card content -->
            <article class="card flex-row border-0">
                <header class="card__header">
                    <img src="../assets/images/pic.jpg" alt="" class="card__img">
                </header>
                <!-- card main -->
                <main class="card__main p-3 text-light bg-dark col-7">
                    <!-- film title -->
                    <h2 class="card__title fs-3">
                        <?php echo $this->username ?>
                    </h2>
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
            <?php
                //Calling function to create button to modify
                createButtonsFilm($this);
            
            ?>
        </article><!-- final container card -->
        <?php
    
    }


}
