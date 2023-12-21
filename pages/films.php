<?php
session_start();

//Set table name value
$table = isset($_POST['table']) ? htmlspecialchars(($_POST['table'])) : 'peliculas';
require '../lib/functions.php';
//Require class files
require '../lib/model/Actor.php';
require '../lib/model/Pelicula.php';
require '../lib/model/DataBase.php';
require '../lib/model/File.php';
//create file object
$file = new CustomFile('../lib/logs/logFile.csv','Username;Action;Date;Rol;Element;Element Id');
//Create bd object from DataBase
$bd = new DataBase();
require '../lib/files/allowManagement.php';
//Cookie management
require '../lib/files/cookieSession.php';
$lastVisit = isset($_COOKIE[hash('sha256',$id)]) ? htmlspecialchars($_COOKIE[hash('sha256',$id)]) : null;
require '../lib/files/checkOptionUser.php';
//Calling file to get code for loaf films
require '../lib/files/loadFilms.php';
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <!-- OTHERS CSS -->
        <link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/cards.css">
        <link rel="stylesheet" href="../css/modal.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/nav_horizontal.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/responsive.css">
        <!-- FONT-AWESOME REMOTE LIBRARY -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <!--body begin-->
    <body>
        <?php
        if ($rol == 1) {
            ?>
            <!--fixed form for insert button-->
            <form class="form__insert" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <button  class="card__button w-100 card__button--insert p-2 text-dark fs-4" name="option" value="insert">
                    Insertar
                </button>
                <!--hidden input with object values array-->
                <input type="hidden" name='objectIds' value='<?= base64_encode(serialize(array('id', 'titulo', 'genero', 'pais', 'anyo', 'cartel'))) ?>' > 
            </form>
            <?php
        }
        ?>
        <!--container begin-->
        <div class="container center_column">
            <!--header begin-->
            <header class="header center_row">
            </header>
            <!-- nav sticky container -->
            <div class="center_row nav_container">
                <!-- menu icon -->
                <i class="fa-solid fa-bars nav__icon nav__icon--menu" id="menu_icon"></i>
                <!-- user icon -->
                <i class="fa-solid fa-user nav__icon nav__icon--user" id="user_icon"></i>

                <a href="../index.html" class=" center_column container_image">
                    <img src="../assets/images/index/software-development.png" alt="" class="nav__image nav__image--1400">
                    <!-- <img src="../assets/images/index/software-development.png" alt="" class="nav__image nav__image--menu"> -->
                    <h1 class="nav__title">OnlineVideoclub</h1>
                </a>
                <nav class="center_row nav" id="nav">
                    <ul class="nav__list">
                        <li class="center_row nav__item nav__item--home"><a href="../index.php"
                                                                            class="nav__link nav__link--home">Home</a></li>
                        <li class="center_row nav__item nav__item--comma"><a href="./films.php"
                                                                             class="nav__link nav__link--comma">Films</a></li>
                            <?php
                            //Conditional to chek if user rol is 1
                            if ($rol == 1) {
                                ?>
                            <li class="center_row nav__item nav__item--comma"><a href="./users.php"
                                                                                 class="nav__link nav__link--comma">Users</a></li>
                                <?php
                            }
                            ?>

                        <li class="center_row nav__item nav__item--comma"><a href="./contactUs.php"
                                                                             class="nav__link nav__link--comma">Contact Us</a></li>
                        <li class="center_row nav__item nav__item--last"><a href="#"
                                                                            class="nav__link nav__link--last">About</a></li>
                    </ul>
                </nav>
                <?php
                if (isset($sessionCookie)) {
                    ?>
                    <div class="d-flex container__user">
                        <i class="fa-solid fa-user nav__icon nav__icon--session" id="session_icon"></i>
                        <p class="nav__icon"><?= $username ?></p>
                    </div>
                    <?php
                }
                ?>
                <div class="d-flex container__visit">
                    <a class="bg-primary nav__button--visit" href="../lib/files/logOut.php">Log Out</a>
                    <?php
                    if (isset($lastVisit)) {
                        ?>

                        <p class="nav__icon">Last visit: <?= $lastVisit ?></p>

                        <?php
                    }
                    ?>
                </div>
            </div>
            <main class="center_row flex-wrap p-4 main">
                <?php
                //Conditional to check if si set $films array to call for each
                if (isset($films)) {
                    //For each to iterate all films
                    foreach ($films as $peli) {
                        $peli->showAsCard($rol);
                    }
                }
                ?>

            </main>

            <!-- main final -->
            <!-- footer -->
            <footer class=" center_column footer">
                <!-- footer absolute visor -->
                <div class="footer__visor">
                    <!-- footer title -->
                    <h2 class="footer__title">Begin follow us </h2>
                    <!-- social media container  -->
                    <div class="social-media social-media--footer">
                        <a class="social-media__link" href="#" target="_blank">
                            <i class="nav__icon fa-brands fa-github"></i></a>
                        <a class="social-media__link" href="#" target="_blank">
                            <i class="nav__icon fa-brands fa-linkedin"></i></a>
                        <a class="social-media__link" href="#" target="_blank">
                            <i class="nav__icon fa-brands fa-facebook"></i></a>
                        <a class="social-media__link" href="#" target="_blank">
                            <i class="nav__icon fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <!-- title icon -->
                <!-- title lists footer -->
                <h2 class="footer__title--lists"><i class="fa-brands fa-codepen"></i>&nbsp;&nbsp;&nbsp;TheMagicOfCoding</h2>
                <div class="center_row lists">
                    <!-- resources list -->
                    <ul class="footer__list">
                        <h3 class="list__title">Resources</h3>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                    </ul>
                    <!-- company list -->
                    <ul class="footer__list">
                        <h3 class="list__title">Comapnies</h3>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                    </ul>
                    <!-- langujaes list -->
                    <ul class="footer__list">
                        <h3 class="list__title">Languajes</h3>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                    </ul>
                    <!-- featuring list -->
                    <ul class="footer__list">
                        <h3 class="list__title">Featurings</h3>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                    </ul>
                </div>
                <footer class="footer__footer">
                    &#169;2023 TheMagicOfCoding
                </footer>
            </footer>

        </div>
        <!-- BOOTSTRAP JS FILE -->
        <script src="../js/bootstrap.bundle.min.js"></script>
        <!-- OTHER JS FILES -->
        <script src="../js/script.js"></script>
    </body>

</html>