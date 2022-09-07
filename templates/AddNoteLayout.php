<h3>Dodaj Notatkę</h3>

<?php
if ($params->isNoteAdded() && $params->isNoteCreated()) :
?>
    <p class="notice"> Dodano notatkę - <?= $params->getTitle() ?> <i class="fas fa-check"></i></p><br>
<?php
elseif ($params->isNoteAdded() && !$params->isNoteCreated()) :
?>
    <p class="error"> Nie udało się dodać notatki - <?= $params->getTitle() ?> <i class="fas fa-times-circle"></i></p><br>
<?php
endif;
?>
<div>
    <form class="note-form" action="/econote/?action=create" method="post">
        <ul>
            <li>
                <label for="title" title="Wymagane">Tytuł <span class="reqired">*</span></label>
                <input type="text" name="title" class="field-long" required="required">
            </li>
            <li>
                <label for="description"></label>
                <textarea name="description" class="field-long field-textarea" title="Treść Notatki"> </textarea>
            <li>
                <input type="submit" value="Dodaj Notatkę">
            </li>
        </ul>
    </form>
</div>