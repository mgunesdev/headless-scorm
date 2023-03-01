<?php

namespace EscolaLms\Scorm\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetScormTrackRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
//        /** @var User $user */
//        $user = $this->user();
//        return $user->can(ScormPermissionsEnum::SCORM_SET_TRACK, 'api');
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
}
