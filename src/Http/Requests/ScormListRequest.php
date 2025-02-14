<?php

namespace EscolaLms\Scorm\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScormListRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
//        /** @var User $user */
//        $user = $this->user();
//        return $user->can(ScormPermissionsEnum::SCORM_LIST, 'api');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    public function pageParams(): ?int
    {
        return $this->get('per_page') === null || $this->get('per_page') === "0"
            ? 0
            : $this->get('per_page');
    }

    public function searchParams(): ?array
    {
        return $this->except(['limit', 'skip', 'order', 'order_by']);
    }
}
