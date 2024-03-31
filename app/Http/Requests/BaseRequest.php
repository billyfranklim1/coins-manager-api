<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

abstract class BaseRequest extends FormRequest
{
    abstract public function rules(): array;

    final protected function getValidatorInstance(): Validator
    {
        $validatorInstance = parent::getValidatorInstance();

        $validatorInstance->addRules($this->getPaginationRules());

        $validatorInstance->setCustomMessages($this->getPaginationMessages());

        return $validatorInstance;
    }

    private function getPaginationRules(): array
    {
        return [
            'page' => ['integer', 'gte:1'],
            'per_page' => ['integer', 'gte:-1', 'not_in:0'],
        ];
    }

    private function getPaginationMessages(): array
    {
        return [
            'page.integer' => trans('common.page_validation_integer'),
            'page.gte' => trans('common.page_validation_gte'),
            'per_page.integer' => trans('common.per_page_validation_integer'),
            'per_page.gte' => trans('common.per_page_validation_gte'),
            'per_page.not_in' => trans('common.per_page_validation_not_in'),
        ];
    }

    // Converts strings like "false" and "true" to boolean values
    protected function toBoolean($booleable): ?bool
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);    }
}
