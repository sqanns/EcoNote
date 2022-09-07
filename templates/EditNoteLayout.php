<?php
declare(strict_types=1);
?>

<h3>Edytuj</h3>
<div class="modify-note">
    <?php
        if (empty($params->getNote())) :
            echo "Nie udało się otworzyć notatki";
        else :
            $params = $params->getNote();
    ?>
        <form class="note-form" action="/econote/?action=update" method="post">
            <ul>
                <li>
                    <label for="display_title" title="Wymagane">Tytuł <span class="reqired">*</span></label>
                    <input type="text" name="title" class="field-long" value="<?php echo $params['title'] ?>" required="required">
                </li>
                <li>
                    <label for="description"></label>
                    <textarea name="description" class="field-long field-textarea"> <?php echo $params['content'] ?> </textarea>
                </li>
                <li>
                    <p><i>Data utworzenia: <?php echo $params['create_date'] ?></i></p>
                </li>
                <li>
                    <input type="submit" value="Potwierdź zmiany">
                    <input type="submit" formaction="/econote/?action=delete" value="Usuń notatkę" onClick='return confirm("Na pewno chcesz Usunąć notatkę?")'>
                </li>

            </ul>
            <input type="hidden" name="old_title" value="<?php echo $params['title'] ?>" >
        </form>
    <?php
        endif;
    ?>
</div>