<?php


namespace EscolaLms\Scorm\Dtos\Contracts;

use Illuminate\Http\Request;

interface InstantiateFromRequest
{
    public static function instantiateFromRequest(Request $request): self;
}
