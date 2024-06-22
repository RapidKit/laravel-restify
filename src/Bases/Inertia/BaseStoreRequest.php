<?php

namespace RapidKit\LaravelRestify\Bases\Inertia;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    abstract public function rules(): array;

    /**
     * Convert the request to a DTO.
     */
    abstract public function toDto();
}
