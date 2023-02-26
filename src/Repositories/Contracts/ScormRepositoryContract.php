<?php

namespace EscolaLms\Scorm\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface ScormRepositoryContract extends BaseRepositoryContract
{
    public function listQuery(?array $columns = ['*'], ?array $search = []): Builder;
}
