<?php
//storage update value into session variable to check which statement choose when confirm be yes
$_SESSION['option'] = 'update';
//Inicialize array with all Pelicula attributes to iterate as array
//Get object attributes by calling function given table name as parameter
$objectAttributes = getArrayByObject($table, $object);
?>
<!--contianer modal updating-->
<div class="modal_window d-flex flex-column justify-content-around">
    <!--title modal window-->
    <h2 class="modal__title text-light">MODIFICA LOS CAMPOS DE LA PELICULA</h2>
    <!--create tag table-->
    <table>
        <!--table header-->-->
        <thead>
            <?php
            foreach ($objectAttributes as $key => $value) {
                ?>
            <th class="th text-light"><?= $key ?></th>
            <?php
        }
        ?>
<!--            <tr>
            <th class="th text-light">Id</th>
            <th class="th text-light">Título</th>
            <th class="th text-light">Género</th>
            <th class="th text-light">País</th>
            <th class="th text-light">Año</th>
            <th class="th text-light">Cartel</th>
            <th>Actores</th>
        </tr>-->
        </thead>
        <!--begin body table-->
        <tbody>
            <tr>
                <!--Begin updating form-->
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
            foreach ($objectAttributes as $key => $value) {
                ?>
                <!--Open td tag for any input-->
                <td>
                    <?php
                    //Conditional to skip actores field
                    if (!is_array($value)) {
                        createInput(getInputType($key), $key, $value, 'form__input', '', getMaxLeght($key));
                    }
                    ?>
                    <!--Close td tag for each input-->
                </td>
                <?php
            }
            ?>
            <!--Open td tag to save input hidden in option input-->
            <td>
                <!--Create hidden input to storage option into int-->
                <?php
                createInput('hidden', 'option', $option, '', '', '');
                ?>
                <!--Close td tag for hidden input-->
            </td>
            <!--Open td tag to save input hidden in object input-->
            <td>
                <!--Create hidden input to storage option into int-->
                <?php
                createInput('hidden', 'film', base64_encode(serialize($object)), '', '', '');
                ?>
                <!--Close td tag for hidden input-->
            </td>
            <!--create button to confirm changes-->
            <td>
                <button class="form__button" type="submit" name='option' value="confirm">Confirmar</button>
            </td>
            <!--Final form-->
        </form>
        </tr>
        <!--final body table-->
        </tbody>
        <!--final table-->
    </table>
    <!--modal container final-->

    <!--button to get out-->
    <a class="text-decoration-none bg-primary text-light fs-3 p-2 pe-5 ps-5 form__link" href="<?= getPathByTable($table) ?>">Salir</a>
</div>


