<?php

namespace RapidKit\LaravelRestify\Bases\Inertia;

abstract class BaseUpdateRequest extends BaseStoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    abstract public function rules(): array;
}
