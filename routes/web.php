<?php

use App\Http\Controllers\ArvoreController;
use App\Http\Controllers\ProfileController;
use App\Models\Arvore;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('/arvores')->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/show', function () {
            $arvores = Arvore::with('imagens')->get();
            return Inertia::render('Arvores', [
                'arvores' => $arvores,
                'ifArvores' => filled($arvores)
            ]);
        })->name('arvores.list');

        Route::get('/create', function () {
            return Inertia::render('Arvores/Register');
        })->name('arvores.create');

        // Route::get('/{campaign_user}', function (CampaignUser $campaign_user) {
        //     // dd($campaign_user);
        //     return Inertia::render('Campaign/Show', [
        //         'campaign_user' => $campaign_user
        //     ]);
        // })->name('campaigns.show');

        Route::post('/store', [ArvoreController::class, 'store'])->name('arvores.store');
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



