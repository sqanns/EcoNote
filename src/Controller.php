<?php

declare(strict_types=1);

namespace EcoNote\src;

use Error;

class Controller
{
    /** @var array|null */
    private $getData;
    /** @var array|null */
    private $postData;
    /** @var ViewParams */
    private $viewParams;

    public function __construct(array $getData, array $postData)
    {
        $this->getData = $getData;
        $this->postData = $postData;
        $this->initParamForView($this->postData);
    }

    public function returnPageWithAllNotes(): void
    {
        $this->getData['search'] = $this->getData['search'] ?? "";
        $this->viewParams->setSearchTitle($this->getData['search']);

        $this->viewParams->setTotalNumberForAllNotes($this->countNumberOfPagesForNotes($this->getData['search']));
        $this->getData['page'] = (int)($this->getData['page'] ?? 1);
        $this->viewParams->setPageNumber($this->getData['page'], $this->viewParams->getTotalNumberForAllNotes());

        $this->viewParams->setAllNotes(
            (new Database)->getAllNotes($this->viewParams->getPageNumber()-1, $this->getData['search'])
        );
        View::render("ExploreNotesLayout", $this->viewParams);
    }

    private function initParamForView(array $datFromPost) : void
    {
        $this->viewParams = new ViewParams();
        if ($this->isPOSTContainsNotesData($this->postData)) {
            $this->viewParams->setTitle($datFromPost['title']);
            $this->viewParams->setDescription($datFromPost['description']);
        }
        if(!empty($this->postData['old_title']))
        {
            $this->viewParams->setOldTitle($this->postData['old_title']);
        }
    }

    public function isPOSTContainsNotesData(array $postData): bool
    {
        if (!empty($postData['title']) && isset($postData['description'])) {
            return true;
        }
        return false;
    }

    private function countNumberOfPagesForNotes(string $patternMatch) : ?int {
        $numberNotesInDB = (new Database)->countAllNotes($patternMatch);
        if ($numberNotesInDB < 0) {
            throw new Error("Error of reading number of Notes");
            return null;
        }
        return (int) ceil($numberNotesInDB / 10);
    }

    public function createNote(): void
    {
        if ($this->isPOSTContainsNotesData($this->postData)) {
            $this->viewParams->setNoteWasCreated(
                (new Database)->addNoteToDatabase($this->postData['title'], $this->postData['description'])
            );
            $this->viewParams->setNoteWasAdded(true);
        }
        View::render("AddNoteLayout", $this->viewParams);
    }

    public function editNote(): void
    {
        $this->viewParams->setNote((new Database)->getNote($this->getData['title']));
        View::render("EditNoteLayout", $this->viewParams);
    }

    public function updateNote(): void
    {
        $this->viewParams->setNoteWasUpdated(
            (new Database)->updateNoteInDB(
                $this->postData['title'],
                $this->postData['description'],
                $this->postData['old_title']
            )
        );
        $this->viewParams->setNoteWasModify(true);
        $this->returnPageWithAllNotes();
    }

    public function deleteNote(): void
    {
        $this->viewParams->setNoteWasDeleted((new Database)->deleteFromDB($this->postData['old_title']));
        $this->viewParams->setNoteWasModify(true);
        $this->returnPageWithAllNotes();
    }
}