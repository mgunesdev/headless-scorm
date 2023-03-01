<?php

namespace EscolaLms\Scorm;

use EscolaLms\Scorm\Policies\ScormPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Peopleaps\Scorm\Model\ScormModel;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [

    ];

    public function boot()
    {

    }
}
