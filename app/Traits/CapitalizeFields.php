<?php

namespace App\Traits;

trait CapitalizeFields
{
    protected function capitalizeFields(array $fieldsToCapitalize): void
    {
        foreach ($fieldsToCapitalize as $field) {
            if (!empty($this->$field)) {
                $this->$field = ucwords(strtolower($this->$field));
            }
        }
    }
}
