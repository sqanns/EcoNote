<?php

declare(strict_types=1);

namespace EcoNote\src;

use PDO;
use PDOStatement;
use EcoNote\src\interfaces\IConnectionDB;

class Database
{
    /** @var PDO */
    private $_connectionPDO;

    public function __construct(IConnectionDB $connectionProvider = null)
    {
        if ($connectionProvider === null) {
            $connectionProvider = new MySqlConnection();
        }
        $this->_connectionPDO = $connectionProvider->getConnection();
    }

    public function getAllNotes(int $offset = 0, string $matchPattern = '%', int $limitOnPage = 10): array
    {
        if(empty($matchPattern)) {
            $matchPattern = '%';
        }
        else {
            $matchPattern = '%' . $matchPattern . '%';
        }
        $offset = max($offset, 0);
        $offset *= $limitOnPage;

        /** @var PDOStatement */
        $stmt = $this->_connectionPDO->prepare("SELECT title, LEFT(content, 100) as content, create_date FROM notes
                                                WHERE title LIKE :pattern
                                                LIMIT :offset, :limitOnPage");

        $stmt->bindParam(':pattern', $matchPattern);
        $stmt->bindParam(':limitOnPage', $limitOnPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);


        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return array();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNote(string $title): array
    {
        /** @var PDOStatement */
        $stmt = $this->_connectionPDO->prepare("SELECT title, content, create_date FROM notes
                                                    WHERE title LIKE :title");
        $stmt->bindParam(':title', $title);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return array();
        }
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        return $arr ?: array();
    }

    public function countAllNotes(string $matchPattern = '%') : int
    {
        if(empty($matchPattern)) {
            $matchPattern = '%';
        }
        else {
            $matchPattern = '%' . $matchPattern . '%';
        }
        /** @var PDOStatement */
        $stmt = $this->_connectionPDO->prepare("SELECT count(*) as number FROM notes
                                                WHERE title LIKE :pattern");

        $stmt->bindParam(':pattern', $matchPattern);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return -1;
        }
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $arr['number'];
    }

    public function addNoteToDatabase(string $title, string $description): bool
    {
        if ($this->checkIfNoteExistInDB($title) === $title) {
            return $this->updateNoteInDB($title, $description, $title);
        }

        $isFine = true;

        /** @var PDOStatement */
        $stmt = $this->_connectionPDO->prepare("INSERT INTO notes(title, content) VALUES (:title, :description)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        if (!$stmt->execute()) {
            $isFine = false;
            print_r($stmt->errorInfo());
        }

        $stmt = null;
        return $isFine;
    }

    public function updateNoteInDB(string $title, string $description, string $oldTitle): bool
    {
        $isFine = true;

        /** @var PDOStatement */
        $stmt = $this->_connectionPDO->prepare("UPDATE notes
                                                SET content = :description, title = :title
                                                WHERE title = :oldTitle");

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':oldTitle', $oldTitle);
        $stmt->bindParam(':description', $description);

        if (!$stmt->execute()) {
            $isFine = false;
            print_r($stmt->errorInfo());
        }

        $stmt = null;
        return $isFine;
    }

    private function checkIfNoteExistInDB(string $title): ?string
    {
        /** @var PDOStatement */
        $stmt = $this->_connectionPDO->prepare("SELECT title FROM notes
                                                    WHERE title like :title");
        $stmt->bindParam(':title', $title);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return null;
        }

        $arr = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($arr['title'])) {
            return null;
        }

        $stmt = null;
        return (string) $arr['title'];
    }

    public function deleteFromDB(string $title): bool
    {
        $isFine = true;
        $stmt = $this->_connectionPDO->prepare("DELETE FROM notes
                                                    WHERE title = :title");
        $stmt->bindParam(':title', $title);
        if (!$stmt->execute()) {
            $isFine = false;
            print_r($stmt->errorInfo());
        }

        $stmt = null;
        return $isFine;
    }
}