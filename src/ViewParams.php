<?php

declare(strict_types=1);

namespace EcoNote\src;

class ViewParams
{
    /** @var bool */
    private $_noteAdded = false;
    /** @var bool */
    private $_updated = false;
    /** @var bool */
    private $_created = false;
    /** @var bool */
    private $_deleted = false;
    /** @var bool */
    private $_modify = false;
    /** @var string|null */
    private $_title = null;
    /** @var string */
    private $_searchTitle = "";
    /** @var string|null */
    private $_oldTitle = null;
    /** @var string|null */
    private $_description = null;
    /** @var array|null */
    private $_note = null;
    /** @var array */
    private $_allNotes = array();
    /** @var int */
    private $_pageNumber = 0;
    /** @var int */
    private $_totalNumberForAllNotes = 0;

    public function isNoteAdded(): bool
    {
        return $this->_noteAdded;
    }

    public function setNoteWasAdded(bool $added): void
    {
        $this->_noteAdded = $added;
    }

    public function isNoteUpdated(): bool
    {
        return $this->_updated;
    }

    public function setNoteWasUpdated(bool $updated): void
    {
        $this->_updated = $updated;
    }

    public function isNoteCreated(): bool
    {
        return $this->_created;
    }

    public function setNoteWasCreated(bool $created): void
    {
        $this->_created = $created;
    }

    public function isNoteDeleted(): bool
    {
        return $this->_deleted;
    }

    public function setNoteWasDeleted(bool $deleted): void
    {
        $this->_deleted = $deleted;
    }

    public function isNoteModify(): bool
    {
        return $this->_modify;
    }

    public function setNoteWasModify(bool $modify): void
    {
        $this->_modify = $modify;
    }

    public function getTitle(): ?string
    {
        return $this->_title;
    }

    public function setTitle(?string $title): void
    {
        $this->_title = $title;
    }

    public function getOldTitle(): ?string
    {
        return $this->_oldTitle;
    }

    public function setOldTitle(?string $oldTitle): void
    {
        $this->_oldTitle = $oldTitle;
    }

    public function getDescription(): ?string
    {
        return $this->_description;
    }

    public function setDescription(?string $description): void
    {
        $this->_description = $description;
    }

    public function getNote(): ?array
    {
        return $this->_note;
    }

    public function setNote(array $note): void
    {
        $this->_note = $note;
    }

    public function setAllNotes(array $allNotes): void
    {
        $this->_allNotes = $allNotes;
    }

    public function getAllNotes(): ?array
    {
        return $this->_allNotes;
    }

    public function getTotalNumberForAllNotes(): int
    {
        return $this->_totalNumberForAllNotes;
    }

    public function setTotalNumberForAllNotes(int $totalNumberForAllNotes): void
    {
        $this->_totalNumberForAllNotes = $totalNumberForAllNotes;
    }

    public function getPageNumber(): int
    {
        return $this->_pageNumber;
    }

    public function setPageNumber(int $pageNumber, ?int $totalPage = null): void
    {
        $pageNumber = max($pageNumber, 1);
        if ($totalPage !== null && $pageNumber > $totalPage) {
            $pageNumber = $totalPage;
        }

        $this->_pageNumber = $pageNumber;
    }

    public function getSearchTitle(): string
    {
        return $this->_searchTitle;
    }

    public function setSearchTitle(string $searchTitle): void
    {
        $this->_searchTitle = $searchTitle;
    }
}
