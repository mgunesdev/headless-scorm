<?php


namespace EscolaLms\Scorm\Dtos\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface DtoContract extends Arrayable
{
    public function toArray(): array;
}
