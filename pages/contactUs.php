<?php
session_start();
require_once '../lib/functions.php';
require '../lib/files/allowManagement.php';
//Cookie management
require '../lib/files/cookieSession.php';
$lastVisit = isset($_COOKIE[getSessionCookieName('', $id)]) ? $_COOKIE[getSessionCookieName('', $id)] : null;
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
                <input type="hidden" name='objectIds' value='<?= base64_encode(serialize(array('id', 'username', 'password', 'rol'))) ?>' > 
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
                        <li class="center_row nav__item nav__item--comma"><a href="./users.php"
                                                                             class="nav__link nav__link--comma">Users</a></li>
                        <li class="center_row nav__item nav__item--comma"><a href="./seo.html"
                                                                             class="nav__link nav__link--comma">Seo</a></li>
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
                <h2 class="text-light w-100 text-center mb-5">Send an email to contact us about any issue</h2>
                <!--form to send mail-->
                <form class="row g-3 needs-validation col-xl-8 offset-xl-2 border p-3" novalidate method="post" action="../lib/send.php">
                    <!--username field-->
                    <div class="col-xl-6">
                        <label for="validationCustomUsername" class="form-label text-light">Username</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" name="username" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                    <!--mail title-->
                    <div class="col-xl-6">
                        <label for="validationCustom03" class="form-label text-light">Subject</label>
                        <input type="text" class="form-control" name="subject" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    <!--mail content-->
                    <div class="col-xl-12">
                        <label for="validationCustom04" class="form-label text-light">Content</label>
                        <textarea type="text" class="form-control" name="content" id="validationCustom04" required></textarea>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label text-light" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </form>
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

