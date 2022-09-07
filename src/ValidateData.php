<?php

declare(strict_types=1);

namespace EcoNote\src;

Utils::error_show(false);

class ValidateData
{
    private $dataToValidate;

    public function __construct(?array $dataToValidate)
    {
        $this->dataToValidate = $dataToValidate;
    }

    public function getValidateData(): ?array
    {

        if ($this->dataToValidate === null) {
            return null;
        }

        foreach ($this->dataToValidate as $key => $value) {
            if (!empty($value)) {
                $this->dataToValidate[$key] = $this->secureCheckData((string) $value);
            }
        }

        return $this->dataToValidate;
    }

    //filter_var
    private function secureCheckData(string $dataToValidate): string
    {
        $dataToValidate = trim($dataToValidate);
        $dataToValidate = strip_tags($dataToValidate);
        $dataToValidate = stripslashes($dataToValidate);
        $dataToValidate = htmlspecialchars($dataToValidate);

        return $dataToValidate;
    }
}