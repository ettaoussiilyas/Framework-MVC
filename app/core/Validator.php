<?php

namespace App\Core;

class Validator 
{
    protected array $errors = [];
    protected array $data;

    public function validate(array $data, array $rules): bool 
    {
        $this->data = $data;
        $this->errors = [];

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $this->validateField($field, $rule);
            }
        }

        return empty($this->errors);
    }

    protected function validateField(string $field, string $rule): void 
    {
        $value = $this->data[$field] ?? null;

        switch ($rule) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, 'This field is required');
                }
                break;

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, 'Invalid email format');
                }
                break;

            case 'numeric':
                if (!is_numeric($value)) {
                    $this->addError($field, 'Must be a number');
                }
                break;
        }
    }

    protected function addError(string $field, string $message): void 
    {
        $this->errors[$field][] = $message;
    }

    public function getErrors(): array 
    {
        return $this->errors;
    }

    public function hasErrors(): bool 
    {
        return !empty($this->errors);
    }
}
