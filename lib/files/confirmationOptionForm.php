<h2>¿Estas seguro de que quires realizar esa acción?</h2>
<!--Confirmation form-->
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <button type="submit" name="response" value="yes">Sí</button>
    <button type="submit" name="response" value="no">No</button>
    <!--hidden input to dens mofdification option-->
    <input type="hidden" name="option" value="<?= $option ?>">
    <input type="hidden" name="film" value="<?= base64_encode(serialize($object)) ?>">
</form>
