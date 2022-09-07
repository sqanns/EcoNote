<?php
declare(strict_types=1);
?>

<h3>Notatki</h3>
<?php
if ($params->isNoteUpdated()) :
?>
    <p class="notice"> Udało się zrobić update notatki - <?= $params->getTitle() ?> <i class="fas fa-check"></i></p><br>
<?php
elseif ($params->isNoteDeleted()) :
?>
    <p class="notice"> Usunięto notatkę - <?= $params->getTitle() ?> <i class="fas fa-check"></i></p><br>
<?php
elseif ($params->isNoteModify() && (!$params->isNoteDeleted() || !$params->isNoteUpdated())) :
?>
    <p class="error"> Nie powiodła się operacja z notatką - <?php echo $params->getTitle() ?> <i class="fas fa-times-circle"></i></p><br>
<?php
endif;
?>
<form action="/econote/" method="get" class="search">
    <input type="text" name="search" class="field-medium" title="Po tytule" value="<?= $params->getSearchTitle() ?>">
    <input type="submit" value="Szukaj" class="squeeze">
</form>
<div class="all-notes">
<?php
if (empty($params->getAllNotes())) :
?>
        <p>Nie znaleziono zapisanych notatek</p>
<?php
else :
    $allNotes = $params->getAllNotes();
    foreach ($allNotes as $note) :
?>
        <a href="/econote/?action=edit&title=<?= $note['title']; ?>">
            <div class="display-note" title="Data utworzenia: <?= $note['create_date'] ?>">
                <header class="note"><?= $note['title']; ?></header>
                <br>
                <p>
                    <?= strlen($note['content']) >= 100 ? $note['content'] . '...' : $note['content'] ?>
                </p>
            </div>
        </a>
<?php
    endforeach;
endif;
?>
</div>
<div class="pagination">
    <a href="/econote/?action=update&page=<?= ($params->getPageNumber()-1) ?>&search=<?= $params->getSearchTitle() ?>"
    <?php if($params->getPageNumber() <= 1) echo 'class="disable-link"' ?> >
        <button class="pagination <?php if($params->getPageNumber() <= 1) echo 'inactive' ?>">
        <i class="fas fa-arrow-left"></i></button>
    </a>
     <span>Strona - <?php echo ($params->getPageNumber()). "/" . $params->getTotalNumberForAllNotes() ?> </span>
    <a href="/econote/?action=update&page=<?= ($params->getPageNumber()+1) ?>&search=<?= $params->getSearchTitle() ?>"
    <?php if($params->getPageNumber() >= $params->getTotalNumberForAllNotes()) echo 'class="disable-link"' ?>>
        <button class="pagination <?php if($params->getPageNumber() >= $params->getTotalNumberForAllNotes()) echo 'inactive' ?>">
        <i class="fas fa-arrow-right"></i></button>
    </a>
</div>