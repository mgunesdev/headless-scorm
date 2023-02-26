<?php

namespace EscolaLms\Scorm\Policies;

use App\Models\User;
use EscolaLms\Scorm\Enums\ScormPermissionsEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use Peopleaps\Scorm\Model\ScormModel;

class ScormPolicy
{
    public function list(User $user): bool
    {
//        return $user->can(ScormPermissionsEnum::SCORM_LIST);
        return true;
    }

    public function read(User $user): bool
    {
//        return $user->can(ScormPermissionsEnum::SCORM_READ);
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
//        return $user->can(ScormPermissionsEnum::SCORM_CREATE);
        return true;
    }

    /**
     * @param User $user
     * @param ScormModel $scorm
     * @return bool
     */
    public function delete(User $user, ScormModel $scorm): bool
    {
//        return $user->can(ScormPermissionsEnum::SCORM_DELETE);
        return true;
    }

    /**
     * @param User $user
     * @param ScormModel $scorm
     * @return bool
     */
    public function update(User $user, ScormModel $scorm): bool
    {
//        return $user->can(ScormPermissionsEnum::SCORM_UPDATE);
        return true;
    }
}
