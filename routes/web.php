<?php

use App\Http\Controllers\Admin\ProgrammeController;
use App\Http\Controllers\Admin\EtudiantController;


Route::middleware('auth')->group(function () {

    Route::prefix('/programmes')->controller(ProgrammeController::class)->group(function () {
        // Index routes
        Route::get('/niveaux', 'indexNiveau')->name('programmes.indexNiveau');
        Route::get('/filieres', 'indexFiliere')->name('programmes.indexFiliere');
        Route::get('/annees', 'indexAnnee')->name('programmes.indexAnnee');
        Route::get('/semestres', 'indexSemestre')->name('programmes.indexSemestre');
        Route::get('/matieres', 'indexMatiere')->name('programmes.indexMatiere');
        Route::get('/classes', 'indexClasse')->name('programmes.indexClasse');


        // Store routes
        Route::post('/niveaux/store', 'storeNiveau')->name('programmes.storeNiveau');
        Route::post('/filieres/store', 'storeFiliere')->name('programmes.storeFiliere');
        Route::post('/annees/store', 'storeAnnee')->name('programmes.storeAnnee');
        Route::post('/semestres/store', 'storeSemestre')->name('programmes.storeSemestre');
        Route::post('/matieres/store', 'storeMatiere')->name('programmes.storeMatiere');
        Route::post('/classes/store', 'storeClasse')->name('programmes.storeClasse');

        // Show routes
        Route::get('/filieres/{id}', 'showFiliere')->name('programmes.showFiliere');

        // Update routes
        Route::put('/niveaux/update/{id}', 'updateNiveau')->name('programmes.updateNiveau');
        Route::put('/filieres/update/{id}', 'updateFiliere')->name('programmes.updateFiliere');
        Route::put('/annees/update/{id}', 'updateAnnee')->name('programmes.updateAnnee');
        Route::put('/semestres/update/{id}', 'updateSemestre')->name('programmes.updateSemestre');
        Route::put('/matieres/update/{id}', 'updateMatiere')->name('programmes.updateMatiere');
        Route::put('/classes/update/{id}', 'updateClasse')->name('programmes.updateClasse');

        // Delete routes
        Route::delete('/niveaux/delete/{id}', 'destroyNiveau')->name('programmes.destroyNiveau');
        Route::delete('/filieres/delete/{id}', 'destroyFiliere')->name('programmes.destroyFiliere');
        Route::delete('/annees/delete/{id}', 'destroyAnnee')->name('programmes.destroyAnnee');
        Route::delete('/semestres/delete/{id}', 'destroySemestre')->name('programmes.destroySemestre');
        Route::delete('/matieres/delete/{id}', 'destroyMatiere')->name('programmes.destroyMatiere');
        Route::delete('/classes/delete/{id}', 'destroyClasse')->name('programmes.destroyClasse');

        Route::prefix('affectations')->group(function () {
            Route::get('/matieresToFiliere/{id}', 'indexMatiereToFiliere')->name('programmes.indexMatiereToFiliere');
            Route::put('/AffectToFiliere/{filiere}', 'updateAffectToFiliere')->name('programmes.updateAffectToFiliere');
        });
        
    });
    

    

    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
    Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
    Route::get('/etudiants/edit/{id}', [EtudiantController::class, 'edit'])->name('etudiants.edit');
    Route::post('/etudiants/store', [EtudiantController::class, 'store'])->name('etudiants.store');    
    Route::put('/etudiants/update/{id}', [EtudiantController::class, 'update'])->name('etudiants.update');
    Route::delete('/etudiants/delete/{id}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
});

require __DIR__.'/auth.php';