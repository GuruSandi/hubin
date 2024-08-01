<?php

namespace App\Providers;

use App\Models\absensisiswa;
use App\Models\jurnal;
use App\Models\nilai_pkl;
use App\Policies\AbsensiSiswaPolicy;
use App\Policies\JurnalPolicy;
use App\Policies\NilaiPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        absensisiswa::class => AbsensiSiswaPolicy::class,
        jurnal::class => JurnalPolicy::class,
        nilai_pkl::class => NilaiPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
