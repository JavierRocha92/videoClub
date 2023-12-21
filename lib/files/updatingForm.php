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
    <!--SE DEBE DE IMPLEMENTAR UN METODO PARA OBTENER EL TITULO DE LA TABLA-->
    <!--create tag table-->
    <table>
        <!--table header-->-->
        <thead>
            <?php
            foreach ($objectAttributes as $key => $value) {
                //Condtitnoal to skip array attributes
                if (!is_array($value)) {
                    ?>
                <th class="th text-light"><?= $key ?></th>
                <?php
            }//End conditional
        }//Enf for each
        ?>
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
                        createInput(getInputType($key), $key, $value, 'form__input', '', getMaxLeght($value), getPattern($value));
                    }
                    ?>
                    <!--Close td tag for each input-->
                </td>
                <?php
            }//Final foar each
            ?>
            <!--Open td tag to save input hidden in option input-->
            <td>
                <!--Create hidden input to storage option into int-->
                <?php
                createInput('hidden', 'option', $option, '', '', '','');
                ?>
                <!--Close td tag for hidden input-->
            </td>
            <!--Open td tag to save input hidden in object input-->
            <td>
                <!--Create hidden input to storage option into int-->
                <?php
                createInput('hidden', 'object', base64_encode(serialize($object)), '', '', '','');
                ?>
                <!--Close td tag for hidden input-->
            </td>
            <!--Open td tag to save input hidden in table input-->
            <td>
                <!--Create hidden input to storage option into int-->
                <?php
                createInput('hidden', 'table', 'peliculas', '', '', '','');
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
    <!--Actor table title-->
    <h2 class="modal__title text-light">Actores</h2>
    <!--create table and form for actors-->
    <!--opne tag table for actors-->
    <table>
        <!--table header-->-->
        <thead>
            <tr>
                <th class="th text-light">Id</th>
                <th class="th text-light">Nombre</th>
                <th class="th text-light">Apellidos</th>
                <th class="th text-light">Fotografía</th>
            </tr>
        </thead>
        <!--Final header table-->
        <!--Oopen body table-->
        <tbody>
            <?php
            //Conditinal to check if actor values exists
            if (isset($objectAttributes['actores'])) {
//                Open tr tag for attributes

                foreach ($objectAttributes['actores'] as $actor) {
                    ?>
                    <!--Open tr tag-->
                    <tr>
                        <!--Open actors form-->
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
                    <?php
                    foreach ($actor as $key => $value) {
                        ?>
                        <!--Open td tag for ech attribute-->
                        <td>
                            <?php
                            createInput(getInputType($key), $key, $value, 'form__input', '', getMaxLeght($value),'');
                            ?>
                        </td>
                        <!--Close td tag for each attribute-->

                        <?php
                    }//End nest for each
                    ?>
                    <!--Open td tag to save input hidden in option input-->
                    <td>
                        <!--Create hidden input to storage option into int-->
                        <?php
                        createInput('hidden', 'option', $option, '', '', '','');
                        ?>
                        <!--Close td tag for hidden input-->
                    </td>
                    <!--Open td tag to save input hidden in object input-->
                    <td>
                        <!--Create hidden input to storage option into int-->
                        <?php
                        createInput('hidden', 'object', base64_encode(serialize($actor)), '', '', '','');
                        ?>
                        <!--Close td tag for hidden input-->
                    </td>
                    <!--Open td tag to save input hidden in object input-->
                    <td>
                        <!--Create hidden input to storage table into int-->
                        <?php
                        createInput('hidden', 'table', 'actores', '', '', '','');
                        ?>
                        <!--Close td tag for hidden input-->
                    </td>
                    <!--create button to confirm changes-->
                    <td>
                        <button class="form__button" type="submit" name='option' value="confirm">Confirmar</button>
                    </td>
                    <!--Close tr tag--> 
                    <!--Close actor form-->
                </form>
                </tr>
                <!--Close tr tag--> 
                <?php
            }//End father for each
        }//End of array conditional
        ?>
        <!--Close tbody-->
        </tbody>
        <!--Close table actors tag-->
    </table>

    <!--button to get out-->
    <a class="text-decoration-none bg-primary text-light fs-3 p-2 pe-5 ps-5 form__link" href="<?= getPathByTable($table) ?>">Salir</a>
</div>
<!--modal container final-->


