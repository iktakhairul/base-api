<?php

namespace App\Http\Validators;


use Illuminate\Support\Facades\DB;

class JsonIdsValidators
{
    /**
     * Register the json ids' validation which validates
     *
     * @return boolean
     */
    public function validateJsonIds($attribute, $value, $parameters, $validator)
    {
        $tableName = $parameters[0];
        $column = $parameters[1];
        $ids = \json_decode($value);
        if (!is_null($ids)) {
            $notFoundRows = [];
            foreach ($ids as $id) {
                $table = DB::table($tableName);
                $rowFound = $table->where($column, $id)->count();
                if ($rowFound < 1) {
                    $notFoundRows[] = $id;
                }
            }

            return count($notFoundRows) === 0;
        } else {
            return true;
        }


    }

    /**
     * Replace original message with our custom one
     *
     * @return string
     */
    public function validationMessage($message, $attribute, $rule, $parameters)
    {
        return sprintf('Some of the id of field %s doesn\'t exist', $attribute);        return sprintf('The %s field must be a valid comma separated list of %s values', $attribute, $parameters[0]);
    }
}
