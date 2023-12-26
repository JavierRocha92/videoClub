<?php
//storage insert value into session variable to check which statement choose when confirm be yes
$_SESSION['option'] = 'insert';
//Coditinal to storage post value actor if is set
$objectIds = isset($_POST['actors']) ? array('id','nombre','apellidos','cartel') : array('id','titulo','genero','pais','anyo','cartel');
$title = isset($_POST['actors']) ? 'INSERTA LOS CAMPOS DEL ACTOR' : 'INSERTA LOS CAMPOS DE LA PELICULA';
$table = isset($_POST['actors']) ? 'actores' : 'peliculas';
?>
<!--container table insertion-->
<div class="modal_window d-flex flex-column justify-content-around">
    <!--title modal window-->
    <h2 class="modal__title text-light"><?= $title ?></h2>
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
                    createInput(getInputType($value), $value, '', 'form__input', $value, getMaxLeght($value), getPattern($value));
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
                createInput('hidden', 'option', $option, '', '', '','');
                ?>
                <!--Close td tag for hidden input-->
            </td>
            <!--Open td tag to save input hidden in table input-->
            <td>
                <!--Create hidden input to storage table into int-->
                <?php
                createInput('hidden', 'table', $table, '', '', '','');
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
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
         <input type="hidden" name="option" value="insert">
        <?php
        //Codnitinal to check if user is inserting a actor
        if(isset($_POST['actors'])){
            ?>
         <button type="submit" class="form__button" name="films">Peliculas</button>
         <?php
            
        }else{
            ?>
         <button type="submit" class="form__button" name="actors">Actor</button>
         <?php
        }
        ?>
        
    </form>
    <!--button to get out-->
    <a class="text-decoration-none bg-primary text-light fs-3 p-2 pe-5 ps-5 form__link" href="<?= getPathByTable($table) ?>">Salir</a>
</div>



