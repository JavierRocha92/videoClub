
<!--contianer modal updating-->
<div class="modal_window d-flex flex-column justify-content-around">
    <h2>Tu sesión ha caducado, ¿ Quires mantenerla activa?</h2>
    <form class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <button class="form__input" type="submit" name="optionExtends" value="yes">Si</button>
        <button class="form__input" type="submit" name="optionExtends" value="no">No</button>
    </form>

    <!--button to get out-->
    <a class="text-decoration-none bg-primary text-light fs-3 p-2 pe-5 ps-5 form__link" href="<?= getPathByTable($table) ?>">Salir</a>
</div>
<!--modal container final-->


