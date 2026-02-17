<?php

use Illuminate\Support\Facades\Route;

$mainDomain = parse_url(config('app.url'), PHP_URL_HOST);
$isLocal = ($mainDomain && (in_array($mainDomain, ['localhost', '127.0.0.1']) || str_ends_with($mainDomain, '.test')));

// Route Group Definier
$registerRoutes = function ($domain = null) {
    // 1. Super Admin Routes
    $superConfig = ['middleware' => ['auth', 'role:super-admin']];
    if ($domain) {
        $superConfig['domain'] = 'super.' . $domain;
    }
    else {
        $superConfig['prefix'] = 'superadmin';
    }

    Route::group($superConfig, function () {
            Route::get('/dashboard', [\App\Http\Controllers\SuperAdmin\DashboardController::class , 'index'])->name('superadmin.dashboard');
            Route::resource('user', \App\Http\Controllers\SuperAdmin\UserController::class)->names('superadmin.user');
            Route::post('user/{user}/toggle', [\App\Http\Controllers\SuperAdmin\UserController::class , 'toggleStatus'])->name('superadmin.user.toggleStatus');
            Route::post('user/{user}/reset-password', [\App\Http\Controllers\SuperAdmin\UserController::class , 'resetPassword'])->name('superadmin.user.resetPassword');

            Route::get('system', [\App\Http\Controllers\SuperAdmin\SystemController::class , 'index'])->name('superadmin.system');
            Route::get('search', [\App\Http\Controllers\SearchController::class , 'search'])->name('superadmin.search');
            Route::post('system/update', [\App\Http\Controllers\SuperAdmin\SystemController::class , 'updateSettings'])->name('superadmin.system.updateSettings');
            Route::post('system/backup', [\App\Http\Controllers\SuperAdmin\SystemController::class , 'backup'])->name('superadmin.system.backup');
            Route::post('lock/{target}', [\App\Http\Controllers\SuperAdmin\SystemController::class , 'lockPage'])->name('superadmin.system.lockPage');
            Route::post('logout', [\App\Http\Controllers\SuperAdmin\Auth\SuperAdminLoginController::class , 'destroy'])->name('superadmin.logout');

            Route::get('/', function () {
                    return redirect()->route('superadmin.dashboard');
                }
                );
            }
            );

            // 2. Admin Routes
            $adminConfig = ['middleware' => ['auth', 'lock:admin']];
            if ($domain) {
                $adminConfig['domain'] = 'admin.' . $domain;
            }
            else {
                $adminConfig['prefix'] = 'admin';
            }

            Route::group($adminConfig, function () {
            Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class , 'index'])
                ->middleware(['verified'])
                ->name('dashboard');
            Route::get('search', [\App\Http\Controllers\SearchController::class , 'search'])->name('admin.search');

            Route::middleware(['role:admin'])->group(function () {
                    // Administration Modules
                    Route::get('keluarga/import', [\App\Http\Controllers\Warga\ImportKeluargaController::class , 'showForm'])->name('keluarga.import');
                    Route::get('keluarga/import/template', [\App\Http\Controllers\Warga\ImportKeluargaController::class , 'downloadTemplate'])->name('keluarga.import.template');
                    Route::post('keluarga/import/preview', [\App\Http\Controllers\Warga\ImportKeluargaController::class , 'preview'])->name('keluarga.import.preview');
                    Route::post('keluarga/import/store', [\App\Http\Controllers\Warga\ImportKeluargaController::class , 'store'])->name('keluarga.import.store');

                    Route::get('warga/import', [\App\Http\Controllers\Warga\ImportPendudukController::class , 'showForm'])->name('warga.import');
                    Route::get('warga/import/template', [\App\Http\Controllers\Warga\ImportPendudukController::class , 'downloadTemplate'])->name('warga.import.template');
                    Route::post('warga/import/preview', [\App\Http\Controllers\Warga\ImportPendudukController::class , 'preview'])->name('warga.import.preview');
                    Route::post('warga/import/store', [\App\Http\Controllers\Warga\ImportPendudukController::class , 'store'])->name('warga.import.store');
                    Route::get('warga/export', [\App\Http\Controllers\Warga\WargaController::class , 'export'])->name('warga.export');

                    Route::delete('warga/destroy-all', [\App\Http\Controllers\Warga\WargaController::class , 'destroyAll'])->name('warga.destroy-all');
                    Route::resource('warga', \App\Http\Controllers\Warga\WargaController::class);

                    Route::delete('keluarga/destroy-all', [\App\Http\Controllers\Warga\KeluargaController::class , 'destroyAll'])->name('keluarga.destroy-all');
                    Route::resource('keluarga', \App\Http\Controllers\Warga\KeluargaController::class);

                    Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class);
                    Route::resource('jenis-surat', \App\Http\Controllers\Admin\JenisSuratController::class);

                    Route::resource('pengumuman', \App\Http\Controllers\Admin\PengumumanController::class);
                    Route::resource('agenda', \App\Http\Controllers\Admin\AgendaController::class);
                    Route::resource('galeri', \App\Http\Controllers\Admin\GaleriController::class);
                    Route::resource('dokumen', \App\Http\Controllers\Admin\DokumenController::class);

                    Route::resource('apbdes', \App\Http\Controllers\Admin\ApbdesController::class);
                    Route::resource('umkm', \App\Http\Controllers\Admin\UmkmController::class);
                    Route::resource('wisata', \App\Http\Controllers\Admin\WisataController::class);

                    Route::resource('kontak', \App\Http\Controllers\Admin\KontakController::class)->only(['index', 'show', 'destroy']);

                    Route::post('/surat/{id}/process', [\App\Http\Controllers\Admin\SuratController::class , 'process'])->name('surat.process');
                    Route::post('/surat/{id}/reject', [\App\Http\Controllers\Admin\SuratController::class , 'reject'])->name('surat.reject');
                    Route::post('/surat/{id}/finish', [\App\Http\Controllers\Admin\SuratController::class , 'finish'])->name('surat.finish');
                    Route::get('/surat/{id}/download', [\App\Http\Controllers\Admin\SuratController::class , 'download'])->name('surat.download');
                    Route::resource('surat', \App\Http\Controllers\Admin\SuratController::class);

                    Route::post('/pengaduan/{id}/process', [\App\Http\Controllers\Admin\PengaduanController::class , 'process'])->name('pengaduan.process');
                    Route::post('/pengaduan/{id}/reply', [\App\Http\Controllers\Admin\PengaduanController::class , 'reply'])->name('pengaduan.reply');
                    Route::delete('/pengaduan/destroy-all', [\App\Http\Controllers\Admin\PengaduanController::class , 'destroyAll'])->name('pengaduan.destroy-all');
                    Route::resource('pengaduan', \App\Http\Controllers\Admin\PengaduanController::class);

                    Route::post('/antrian/call-next', [\App\Http\Controllers\Admin\AntrianController::class , 'callNext'])->name('antrian.call-next');
                    Route::post('/antrian/{id}/complete', [\App\Http\Controllers\Admin\AntrianController::class , 'complete'])->name('antrian.complete');
                    Route::post('/antrian/{id}/cancel', [\App\Http\Controllers\Admin\AntrianController::class , 'cancel'])->name('antrian.cancel');
                    Route::delete('/antrian/clear-all', [\App\Http\Controllers\Admin\AntrianController::class , 'clearAll'])->name('antrian.clear-all');
                    Route::get('/antrian', [\App\Http\Controllers\Admin\AntrianController::class , 'index'])->name('antrian.index');

                    Route::delete('/audit/destroy-all', [\App\Http\Controllers\Admin\AuditController::class , 'destroyAll'])->name('audit.destroy-all');
                    Route::resource('audit', \App\Http\Controllers\Admin\AuditController::class)->only(['index', 'show']);

                    Route::get('pengaturan', [\App\Http\Controllers\Admin\SettingController::class , 'index'])->name('pengaturan.index');
                    Route::patch('pengaturan', [\App\Http\Controllers\Admin\SettingController::class , 'update'])->name('pengaturan.update');
                }
                );

                Route::get('/profile', [\App\Http\Controllers\ProfileController::class , 'edit'])->name('profile.edit');
                Route::patch('/profile', [\App\Http\Controllers\ProfileController::class , 'update'])->name('profile.update');
                Route::delete('/profile', [\App\Http\Controllers\ProfileController::class , 'destroy'])->name('profile.destroy');

                Route::get('/', function () {
                    return redirect()->route('dashboard');
                }
                );
            }
            );

            // 3. Public Routes
            $publicConfig = ['middleware' => ['lock:user']];
            if ($domain) {
                $publicConfig['domain'] = $domain;
            }

            Route::group($publicConfig, function () {
            Route::get('/', [\App\Http\Controllers\HomeController::class , 'index'])->name('home');
            Route::get('/profil-desa', [\App\Http\Controllers\Publik\ProfilDesaController::class , 'index'])->name('public.profil.index');
            Route::get('/visi-misi', [\App\Http\Controllers\Publik\ProfilDesaController::class , 'visiMisi'])->name('public.profil.visi-misi');
            Route::get('/struktur-organisasi', [\App\Http\Controllers\Publik\ProfilDesaController::class , 'struktur'])->name('public.profil.struktur');
            Route::get('/sejarah-desa', [\App\Http\Controllers\Publik\ProfilDesaController::class , 'sejarah'])->name('public.profil.sejarah');

            Route::get('/berita', [\App\Http\Controllers\NewsController::class , 'index'])->name('public.berita.index');
            Route::get('/berita/{slug}', [\App\Http\Controllers\NewsController::class , 'show'])->name('public.berita.show');

            Route::get('/galeri', [\App\Http\Controllers\Publik\GaleriController::class , 'index'])->name('public.galeri.index');
            Route::get('/umkm', [\App\Http\Controllers\Publik\UmkmController::class , 'index'])->name('public.umkm.index');
            Route::get('/wisata', [\App\Http\Controllers\Publik\WisataController::class , 'index'])->name('public.wisata.index');
            Route::get('/wisata/{slug}', [\App\Http\Controllers\Publik\WisataController::class , 'show'])->name('public.wisata.show');
            Route::get('/agenda', [\App\Http\Controllers\Publik\AgendaController::class , 'index'])->name('public.agenda.index');
            Route::get('/agenda/{id}', [\App\Http\Controllers\Publik\AgendaController::class , 'show'])->name('public.agenda.show');
            Route::get('/pengumuman', [\App\Http\Controllers\Publik\PengumumanController::class , 'index'])->name('public.pengumuman.index');
            Route::get('/pengumuman/{id}', [\App\Http\Controllers\Publik\PengumumanController::class , 'show'])->name('public.pengumuman.show');
            Route::get('/dokumen', [\App\Http\Controllers\Publik\DokumenController::class , 'index'])->name('public.dokumen.index');
            Route::get('/apbdes', [\App\Http\Controllers\Publik\ApbdesController::class , 'index'])->name('public.apbdes.index');

            Route::get('/lapor', [\App\Http\Controllers\Publik\PengaduanPublikController::class , 'create'])->name('public.pengaduan.create');
            Route::post('/lapor', [\App\Http\Controllers\Publik\PengaduanPublikController::class , 'store'])->name('public.pengaduan.store');
            Route::get('/lapor/berhasil/{ticket}', [\App\Http\Controllers\Publik\PengaduanPublikController::class , 'success'])->name('public.pengaduan.success');
            Route::get('/lapor/status', [\App\Http\Controllers\Publik\PengaduanPublikController::class , 'checkStatus'])->name('public.pengaduan.check');

            Route::get('/antrian', [\App\Http\Controllers\Publik\AntrianPublikController::class , 'create'])->name('public.antrian.create');
            Route::post('/antrian', [\App\Http\Controllers\Publik\AntrianPublikController::class , 'store'])->name('public.antrian.store');
            Route::get('/antrian/berhasil/{token}', [\App\Http\Controllers\Publik\AntrianPublikController::class , 'success'])->name('public.antrian.success');
            Route::get('/antrian/status', [\App\Http\Controllers\Publik\AntrianPublikController::class , 'checkStatus'])->name('public.antrian.check');

            Route::get('/v/{uuid}', [\App\Http\Controllers\Publik\VerificationController::class , 'verify'])->name('surat.verify');

            Route::get('/layanan-surat', [\App\Http\Controllers\Publik\SuratPublikController::class , 'create'])->name('public.surat.create');
            Route::post('/layanan-surat', [\App\Http\Controllers\Publik\SuratPublikController::class , 'store'])->name('public.surat.store');
            Route::get('/layanan-surat/berhasil', [\App\Http\Controllers\Publik\SuratPublikController::class , 'success'])->name('public.surat.success');
        }
        );
    };

if ($isLocal) {
    $registerRoutes();
}
else {
    $registerRoutes($mainDomain);
}

// Guest routes for Super Admin access
Route::middleware('guest')->group(function () {
    Route::get('superadmin/access', [\App\Http\Controllers\SuperAdmin\Auth\SuperAdminLoginController::class , 'create'])->name('superadmin.login');
    Route::post('superadmin/access', [\App\Http\Controllers\SuperAdmin\Auth\SuperAdminLoginController::class , 'store'])->name('superadmin.login.store');
});

require __DIR__ . '/auth.php';
