<?php
//Require for usign functions file
session_start();
require './lib/functions.php';
$sessionActive = false;
if (isset($_SESSION['username']) && isset($_SESSION['rol']) && isset($_SESSION['id'])) {
    $id = htmlspecialchars($_SESSION['id']);
    $rol = htmlspecialchars($_SESSION['rol']);
    $username = htmlspecialchars($_SESSION['username']);
    $sessionActive = true;
}
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <!-- OTHERS CSS -->
        <link rel="stylesheet" href="./css/all.css">
        <link rel="stylesheet" href="./css/normalize.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/nav_horizontal.css">
        <link rel="stylesheet" href="./css/footer.css">
        <link rel="stylesheet" href="./css/form.css">
        <link rel="stylesheet" href="./css/responsive.css">
        <link rel="stylesheet" href="./css/errors.css">
        <link rel="stylesheet" href="./css/modal.css">
        <!-- FONT-AWESOME REMOTE LIBRARY -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>

    <body>
        <div class="container center_column">
            <header class="header">
            </header>
            <!-- nav sticky container -->
            <div class="center_row nav_container">
                <!-- menu icon -->
                <i class="fa-solid fa-bars nav__icon nav__icon--menu" id="menu_icon"></i>
                <!-- user icon -->
                <i class="fa-solid fa-user nav__icon nav__icon--user" id="user_icon"></i>
                <a href="./index.html" class=" center_column container_image">
                    <img src="./assets/images/index/software-development.png" alt="" class="nav__image nav__image--1400">
                    <!-- <img src="../assets/images/index/software-development.png" alt="" class="nav__image nav__image--menu"> -->
                    <h1 class="nav__title">VideoClubOnline</h1>
                </a>
                <nav class="center_row nav" id="nav">
                    <ul class="nav__list">
                        <li class="center_row nav__item nav__item--home"><a href="./index.php"
                                                                            class="nav__link nav__link--home">Home</a></li>
                        <li class="center_row nav__item nav__item--comma"><a href="./pages/films.php"
                                                                             class="nav__link nav__link--comma">Films</a></li>
                        <li class="center_row nav__item nav__item--comma"><a href="./pages/contactUs.php"
                                                                             class="nav__link nav__link--comma">Contact Us</a></li>
                        <li class="center_row nav__item nav__item--comma"><a href="#"
                                                                             class="nav__link nav__link--comma">prueba2</a></li>
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

                    <div class="d-flex container__visit">
                        <a class="bg-primary nav__button--visit" href="../lib/files/logOut.php">Log Out</a>
                        <?php
                        if (isset($lastVisit)) {
                            ?>

                            <p class="nav__icon">Last visit: <?= $lastVisit ?></p>

                            <?php
                        }//final lastvisit conditional
                        ?>
                    </div>
                    <?php
                }//Fianl sessionCookie conditional
                ?>

            </div>

            <!-- main -->
            <main class="center_column main">
                <?php
                //Conditional to cehck if a session is active to show or hide forms
                if (!$sessionActive) {
                    ?>
                    <!-- container for two form -->
                    <div class="container_forms" id="container__forms">
                        <?php
                        //Conditional to load sign up form
                        if (isset($_GET['register'])) {
                            ?>
                            <!-- container for sign up form -->
                            <div class="center_column container__form container__form--signup" id="signup">
                                <!-- form title -->
                                <div class="form__title_container">
                                    <h2 class="form__title">Create an account
                                    </h2>
                                    <i class="fa-solid fa-circle-xmark icon"></i>

                                </div>
                                <?php
                                //Conditinal to check if error id is in $_GET variable
                                if (isset($_GET['error'])) {
                                    //Calling function to display a specific error
                                    displayError('Debes de estar registrado para acceder');
                                }
                                ?>
                                <!-- contianer for accounts google and facebook -->
                                <div class="center_column form__others_account">
                                    <div class="form__others_container">
                                        <a class="form__icon" href="" target="_blank">
                                            <i class="fa-brands fa-google form__icon--red"></i>
                                            &nbsp;&nbsp;&nbsp;Sign up with Google
                                        </a>
                                    </div>
                                    <div class="form__others_container">
                                        <a class="form__icon" href="" target="_blank">
                                            <i class="fa-brands fa-facebook-f form__icon--blue"></i>
                                            &nbsp;&nbsp;&nbsp;Sign up with Facebook
                                        </a>
                                    </div>
                                </div>
                                <!-- form to enter your data -->
                                <form action="./lib/files/register.php" method="post" class="center_column form form--login">
                                    <input type="text" required name="id" class="form__input--index" placeholder="Type your id">
                                    <input type="text" required name="username" class="form__input--index" placeholder="Type your username">
                                    <input type="password" required name="password" class="form__input--index" placeholder="Type your password">
                                    <input type="number" required name="rol" class="form__input--index" placeholder="Type your rol">
                                    <div class="center_row checkbox">
                                        <input type="checkbox" name="terms" class="form__input --index form__input--checkbox">
                                        <label class="form__label" for="terms">Accept terms about private policy</label>
                                    </div>
                                    <button class="form__input--index form__button--index" type="submit">Sing Up</button>
                                </form>
                                <!-- footer div for change form -->
                                <div class="form__change">
                                    <a class="form__text" href="./index.php?login" id="login__button">Log in</a>
                                </div>
                            </div>
                            <?php
                            //Condtional to load sign up form
                        } else {
                            ?>
                            <!-- container for login form -->
                            <div class="center_column container__form container__form--login" id="login">
                                <!-- form title -->
                                <div class="form__title_container">
                                    <h2 class="form__title">Type your account
                                    </h2>
                                    <i class="fa-solid fa-circle-xmark icon"></i>
                                </div>
                                <!-- contianer for accounts google and facebook -->
                                <div class="center_column form__others_account">
                                    <div class="form__others_container">
                                        <a class="form__icon" href="" target="_blank">
                                            <i class="fa-brands fa-google form__icon--red"></i>
                                            &nbsp;&nbsp;&nbsp;Log in with Google
                                        </a>
                                    </div>
                                    <div class="form__others_container">
                                        <a class="form__icon" href="" target="_blank">
                                            <i class="fa-brands fa-facebook-f form__icon--blue"></i>
                                            &nbsp;&nbsp;&nbsp;Log in with Facebook
                                        </a>
                                    </div>
                                </div>
                                <!-- form to enter your data -->
                                <form action="./lib/files/login.php" method="post" class="center_column form form--login">
                                    <?php
                                    //Conditinal to check if error id exists into $_GEt variable
                                    if (isset($_GET['error'])) {
                                        //Calling function to display a specific error
                                        displayError('Usuario y/o contraseña incorrectos');
                                    }
                                    ?>
                                    <input type="text" name="username" required class="form__input--index" placeholder="Type your username">
                                    <input type="password" name="password" required class="form__input--index" placeholder="Type your password">
                                    <div class="center_row checkbox">
                                        <input type="checkbox" name="terms" class="form__input--index form__input--checkbox">
                                        <label class="form__label" for="terms">Remember me</label>
                                    </div>
                                    <button class="form__input--index form__button--index" type="submit">Log in</button>
                                </form>
                                <!-- footer div for change form and password link support-->
                                <div class="form__change">
                                    <a class="form__text--link">forget your password?</a>
                                    <a class="form__text" href="./index.php?register" id="signup__button">Sign up</a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }//Final conditional to show forms
                ?>
                <div class="visor">
                    <div class="visor__container-window">
                        <div class="visor__window"></div>
                        <div class="bar">
                            <!-- animatin white bar -->
                        </div>
                    </div>
                    <div class="visor__container-window">
                        <div class="visor__window"></div>
                        <div class="bar">
                            <!-- animatin white bar -->
                        </div>
                    </div>
                    <div class="visor__container-window">
                        <div class="visor__window third"></div>
                        <div class="bar">
                            <!-- animatin white bar -->
                        </div>
                    </div>
                    <div class="visor__container-window">
                        <div class="visor__window fourth"></div>
                        <div class="bar">
                            <!-- animatin white bar -->
                        </div>
                    </div>
                    <div class="visor__container-window">
                        <div class="visor__window fiveth"></div>
                        <div class="bar">
                            <!-- animatin white bar -->
                        </div>
                    </div>
                    <div class="visor__container-window">
                        <div class="visor__window visor__window--last"></div>
                        <div class="bar">
                            <!-- animation white bar -->
                        </div>
                    </div>
                </div>
                <!--final of visor container-->
            </main>
            <!-- main final -->
            <!-- footer -->
            <footer class=" center_column footer">
                <!-- footer absolute visor -->
                <div class="footer__visor">
                    <!-- footer title -->
                    <h2 class="footer__title">Begin follow us </h2>
                    <!-- social media container  -->
                    <div class="social-media social-media--footer ">
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
                        <h3 class="list__title">Companies</h3>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                        <li class="footer__list_item">list element</li>
                    </ul>
                    <!-- langujaes list -->
                    <ul class="footer__list">
                        <h3 class="list__title">Firendly apps</h3>
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
                    &#169;2023 VideoClubOnline
                </footer>
            </footer>


        </div>
        <!-- BOOTSTRAP JS FILE -->
        <script src="./js/bootstrap.bundle.min.js"></script>
        <!-- OTHER JS FILES -->
        <script src="./js/script.js"></script>
    </body>

</html>