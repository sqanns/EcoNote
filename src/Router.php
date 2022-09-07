<?php

declare(strict_types=1);

namespace EcoNote\src;

class Router
{
    /** @var array|null */
    private $getData;
    /** @var array|null */
    private $postData;
    /** @var Controller */
    private $controller;

    public function __construct(array $getData, array $postData)
    {
        $this->getData = (new ValidateData($getData))->getValidateData();
        $this->postData = (new ValidateData($postData))->getValidateData();
        $this->controller = new Controller($this->getData, $this->postData);
    }

    public function start(): void
    {
        $action = $this->getData['action'] ?? null;

        switch (true) {
            case $action === 'create':
                $this->controller->createNote();
                break;
            case $action === 'edit' && !empty($this->getData['title']):
                $this->controller->editNote();
                break;
            case $action === 'update' && !empty($this->postData['old_title']):
                $this->controller->updateNote();
                break;
            case $action === 'delete' && !empty($this->postData['old_title']):
                $this->controller->deleteNote();
                break;
            default:
                $this->controller->returnPageWithAllNotes();
                break;
        }
    }
}