<?php

namespace EscolaLms\Scorm\Repositories\Contracts;

use EscolaLms\Core\Repositories\Contracts\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Builder;

interface ScormRepositoryContract
{
    public function listQuery(?array $columns = ['*'], ?array $search = []): Builder;
}
