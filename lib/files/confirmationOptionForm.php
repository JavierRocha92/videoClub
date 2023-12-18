<!--container modal window-->
<div class="modal_window d-flex flex-column justify-content-center">
    <!--modal title-->
    <h2 class="modal__title text-light pb-5">¿Estas seguro de que quires realizar esa acción?</h2>
    <!--Confirmation form-->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <button class="form__button" type="submit" name="response" value="yes">Sí</button>
        <button class="form__button" type="submit" name="response" value="no">No</button>
        <!--hidden input to dens mofdification option-->
        <input type="hidden" name="option" value="<?= $option ?>">
        <input type="hidden" name="table" value="<?= $table ?>">
        <input type="hidden" name="object" value="<?= base64_encode(serialize($object)) ?>">
    </form>
    <!--endo confirmation form-->
    <!--button to get out-->
     <a class="text-decoration-none bg-primary text-light fs-3 p-2 pe-5 ps-5 form__link" href="films.php">Salir</a>
 </div>
<!--end container modal window-->