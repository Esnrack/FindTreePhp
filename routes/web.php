<?php

use App\Http\Controllers\ArvoreController;
use App\Http\Controllers\ProfileController;
use App\Models\Arvore;
use App\Models\ImagensArvore;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect(route('login', absolute: false));
});

Route::get('/getArvores', function () {
    return Arvore::with('imagens')->get()->toArray();
});

Route::prefix('/arvores')->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/show', function () {
            $arvores = Arvore::with('imagens')->get();
            // dd($arvores);
            return Inertia::render('Arvores', [
                'arvores' => $arvores,
                'ifArvores' => filled($arvores)
            ]);
        })->name('arvores.list');

        Route::get('/create', function () {
            return Inertia::render('Arvores/Register');
        })->name('arvores.create');

        Route::get('/{arvore}', function (Arvore $arvore) {
            // dd($arvore->load('imagens'));
            return Inertia::render('Arvores/Edit', [
                'arvore' => $arvore->load('imagens')
            ]);
        })->name('arvores.edit');

    // Route::get('/{arvore}', [ArvoreController::class, 'edit'])->name('arvores.edit');


        Route::post('/edit', [ArvoreController::class, 'update'])->name('arvores.update');
        Route::post('/store', [ArvoreController::class, 'store'])->name('arvores.store');
        Route::delete('/destroy/{arvore}', function (Arvore $arvore) {
            ImagensArvore::where('arvore_id', '=', $arvore->id)->delete();
            Arvore::where('id', '=', $arvore->id)->delete();

            return Redirect::route('arvores.list');
        })->name('arvores.destroy');
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



