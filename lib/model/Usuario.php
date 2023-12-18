<?php

class Usuario{
    private $id;
    private $username;
    private $password;
    private $rol;
    
    public function __construct($id,$username,$password,$rol){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->rol = $rol;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUsername($username): void {
        $this->username = $username;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }
    
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
