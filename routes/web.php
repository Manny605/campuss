<?php

use App\Http\Controllers\Admin\ProgrammeController;
use App\Http\Controllers\Admin\EtudiantController;
use App\Http\Controllers\Admin\EnseignantController;



Route::middleware('auth')->group(function () {

    Route::prefix('/programmes')->controller(ProgrammeController::class)->group(function () {
        // Index routes
        Route::get('/niveaux', 'indexNiveau')->name('programmes.indexNiveau');
        Route::get('/filieres', 'indexFiliere')->name('programmes.indexFiliere');
        Route::get('/annees', 'indexAnnee')->name('programmes.indexAnnee');
        Route::get('/semestres', 'indexSemestre')->name('programmes.indexSemestre');
        // Route::get('/matieres', 'indexMatiere')->name('programmes.indexMatiere');
        Route::get('/classes', 'indexClasse')->name('programmes.indexClasse');



        // Store routes
        Route::post('/niveaux/store', 'storeNiveau')->name('programmes.storeNiveau');
        Route::post('/filieres/store', 'storeFiliere')->name('programmes.storeFiliere');
        Route::post('/annees/store', 'storeAnnee')->name('programmes.storeAnnee');
        Route::post('/semestres/store', 'storeSemestre')->name('programmes.storeSemestre');
        // Route::post('/matieres/store', 'storeMatiere')->name('programmes.storeMatiere');
        Route::post('/classes/store', 'storeClasse')->name('programmes.storeClasse');

        // Show routes
        Route::get('/filieres/{id}', 'showFiliere')->name('programmes.showFiliere');

        // Update routes
        Route::put('/niveaux/update/{id}', 'updateNiveau')->name('programmes.updateNiveau');
        Route::put('/filieres/update/{id}', 'updateFiliere')->name('programmes.updateFiliere');
        Route::put('/annees/update/{id}', 'updateAnnee')->name('programmes.updateAnnee');
        Route::put('/semestres/update/{id}', 'updateSemestre')->name('programmes.updateSemestre');
        Route::put('/classes/update/{id}', 'updateClasse')->name('programmes.updateClasse');

        // Delete routes
        Route::delete('/niveaux/delete/{id}', 'destroyNiveau')->name('programmes.destroyNiveau');
        Route::delete('/filieres/delete/{id}', 'destroyFiliere')->name('programmes.destroyFiliere');
        Route::delete('/annees/delete/{id}', 'destroyAnnee')->name('programmes.destroyAnnee');
        Route::delete('/semestres/delete/{id}', 'destroySemestre')->name('programmes.destroySemestre');
        Route::delete('/classes/delete/{id}', 'destroyClasse')->name('programmes.destroyClasse');

        Route::prefix('affectations')->group(function () {
            
            Route::get('/filieres/niveaux/{id}', 'indexNiveauxFiliere')->name('programmes.indexNiveauxFiliere');
            Route::put('/AffectNiveauxToFiliere/{filiere}', 'AffectNiveauxToFiliere')->name('programmes.updateAffectNiveauxToFiliere');

            Route::get('/filieres/matieres/{fid}/{sid}', 'createMatieresToFiliere')->name('programmes.createMatieresToFiliere');
            Route::post('/storeMatiere', 'AffectMatieresToFiliere')->name('programmes.AffectMatieresToFiliere');
            Route::put('/matieres/update/{id}', 'updateMatiere')->name('programmes.updateMatiere');
            Route::delete('/matieres/delete/{id}', 'destroyMatiere')->name('programmes.destroyMatiere');

        });
        
    });
    

    Route::prefix('/enseignants')->controller(EnseignantController::class)->group(function () {
        Route::get('/', 'index')->name('enseignants.index');
        Route::get('/create', 'create')->name('enseignants.create');
        Route::post('/store', 'store')->name('enseignants.store');
        Route::get('/edit/{id}', 'edit')->name('enseignants.edit');
        Route::put('/update/{id}', 'update')->name('enseignants.update');
        Route::delete('/delete/{id}', 'destroy')->name('enseignants.destroy');
        Route::get('/matieres/{id}', 'pageAffectMatieres')->name('enseignants.matieres');
    });

    Route::prefix('/etudiants')->controller(EtudiantController::class)->group(function () {
        Route::get('/', 'index')->name('etudiants.index');
        Route::get('/create', 'create')->name('etudiants.create');
        Route::post('/store', 'store')->name('etudiants.store');
        Route::get('/edit/{id}', 'edit')->name('etudiants.edit');
        Route::put('/update/{id}', 'update')->name('etudiants.update');
        Route::delete('/delete/{id}', 'destroy')->name('etudiants.destroy');
    });
});

require __DIR__.'/auth.php';