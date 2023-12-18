<?php
//storage insert value into session variable to check which statement choose when confirm be yes
$_SESSION['option'] = 'insert';
//Inicialize array with all Pelicula attributes to iterate as array
?>
<!--container table insertion-->
<div class="modal_window d-flex flex-column justify-content-around">
    <!--title modal window-->
    <h2 class="modal__title text-light">INSERTA LOS CAMPOS DE LA PELICULA</h2>
    <!--create tag table-->
    <table>
        <!--table header-->
        <thead>
            <tr>
            <?php
            foreach ($objectIds as $value) {
                ?>
            <th class="th text-light"><?= $value ?></th>
            <?php
            }
            
            ?>
             </tr>
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
                <!--Begin inserting form-->
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
            foreach ($objectIds as $key => $value) {
                ?>
                <!--Open td tag for any input-->
                <td>
                    <?php
                    //Conditional to skip actores field
                    createInput(getInputType($value), $value, '', 'form__input', $value, getMaxLeght($key));
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
    <!--final modal container-->

    <!--button to get out-->
    <a class="text-decoration-none bg-primary text-light fs-3 p-2 pe-5 ps-5 form__link" href="<?= getPathByTable($table) ?>">Salir</a>
</div>



