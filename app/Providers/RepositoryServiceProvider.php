<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\PendudukRepositoryInterface;
use App\Repositories\Eloquent\PendudukRepository;
use App\Repositories\Interfaces\KeluargaRepositoryInterface;
use App\Repositories\Eloquent\KeluargaRepository;
use App\Repositories\Interfaces\BeritaRepositoryInterface;
use App\Repositories\Eloquent\BeritaRepository;
use App\Repositories\Interfaces\JenisSuratRepositoryInterface;
use App\Repositories\Eloquent\JenisSuratRepository;
use App\Repositories\Interfaces\SuratRepositoryInterface;
use App\Repositories\Eloquent\SuratRepository;
use App\Repositories\Interfaces\PengaduanRepositoryInterface;
use App\Repositories\Eloquent\PengaduanRepository;
use App\Repositories\Interfaces\AntrianRepositoryInterface;
use App\Repositories\Eloquent\AntrianRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PendudukRepositoryInterface::class , PendudukRepository::class);
        $this->app->bind(KeluargaRepositoryInterface::class , KeluargaRepository::class);
        $this->app->bind(BeritaRepositoryInterface::class , BeritaRepository::class);
        $this->app->bind(JenisSuratRepositoryInterface::class , JenisSuratRepository::class);
        $this->app->bind(SuratRepositoryInterface::class , SuratRepository::class);
        $this->app->bind(PengaduanRepositoryInterface::class , PengaduanRepository::class);
        $this->app->bind(AntrianRepositoryInterface::class , AntrianRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    //
    }
}
