<?php
//Inicialize array with all Pelicula attributes to iterate as array
$objectAttributes = array(
    'id' => $object->getId(),
    'titulo' => $object->getTitulo(),
    'genero' => $object->getGenero(),
    'pais' => $object->getPais(),
    'anyo' => $object->getAnyo(),
    'cartel' => $object->getCartel(),
    'actores' => $object->getActores()
);
?>
<!--create tag table-->
<table>
    <!--table header-->
    <thead>
        <tr>
            <th>Id</th>
            <th>Título</th>
            <th>Género</th>
            <th>País</th>
            <th>Año</th>
            <th>Cartel</th>
            <!--<th>Actores</th>-->
        </tr>
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
                if(!is_array($value)){
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
            <button type="submit" name='option' value="confirm">Confirmar</button>
        </td>
        <!--Final form-->
    </form>
</tr>
<!--final body table-->
</tbody>
<!--final table-->
</table>


