<?php

declare(strict_types=1);

namespace RapidKit\LaravelRestify\Bases;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

abstract class BaseDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Generate a redirect response.
     */
    abstract public function getRedirector(): RedirectResponse;
}
