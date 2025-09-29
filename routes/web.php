<?php

use App\Http\Controllers\Admin\ProgrammeController;
use App\Http\Controllers\Admin\EtudiantController;
use App\Http\Controllers\Admin\EnseignantController;



Route::middleware('auth')->group(function () {

    Route::prefix('/securite_comptes')->group(function () {

        Route::prefix('/utilisateurs')->controller(\App\Http\Controllers\UserController::class)->group(function () {
            Route::get('/', 'index')->name('users.index');

            Route::prefix('role')->group(function() {
                Route::get('/{role}', 'indexUsersByRole')->name('users.indexUsersByRole');
                Route::get('/{role}/create', 'create')->name('users.create');
                Route::get('/{role}/edit/{user}', 'edit')->name('users.edit');
            });



            Route::post('/store', 'store')->name('users.store');
            Route::put('/update/{user}', 'update')->name('users.update');
            Route::delete('/delete/{user}', 'destroy')->name('users.destroy');

        });

        Route::prefix('roles')->controller(\App\Http\Controllers\RoleController::class)->group(function () {
            Route::get('/', 'index')->name('roles.index');
            Route::post('/store', 'store')->name('roles.store');
            Route::put('/update/{role}', 'update')->name('roles.update');
            Route::delete('/delete/{role}', 'destroy')->name('roles.destroy');
            Route::get('/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'PageAffectPermissionsToRole'])->name('roles.PageAffectPermissionsToRole');
            Route::post('/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'AffectPermissionsToRole'])->name('roles.AffectPermissionsToRole');
        });

        Route::prefix('permissions')->controller(\App\Http\Controllers\PermissionController::class)->group(function () {
            Route::get('/', 'index')->name('permissions.index');
            Route::post('/store', 'store')->name('permissions.store');
            Route::put('/update/{permission}', 'update')->name('permissions.update');
            Route::delete('/delete/{permission}', 'destroy')->name('permissions.destroy');
        });

    });

    


    Route::prefix('/programmes')->group(function () {

        Route::prefix('annees')->controller(\App\Http\Controllers\Admin\AnneeController::class)->group(function () {
            Route::get('/', 'index')->name('annees.index');
            Route::post('/store', 'store')->name('annees.store');
            Route::put('/update/{id}', 'update')->name('annees.update');
            Route::delete('/delete/{id}', 'destroy')->name('annees.destroy');
        });

        Route::prefix('filieres')->controller(\App\Http\Controllers\Admin\FiliereController::class)->group(function () {
            Route::get('/', 'index')->name('filieres.index');
            Route::post('/store', 'store')->name('filieres.store');
            Route::put('/update/{id}', 'update')->name('filieres.update');
            Route::delete('/delete/{id}', 'destroy')->name('filieres.destroy');
        });

        Route::prefix('periodes')->controller(\App\Http\Controllers\Admin\PeriodeController::class)->group(function () {
            Route::get('/', 'index')->name('periodes.index');
            Route::post('/store', 'store')->name('periodes.store');
            Route::put('/update/{id}', 'update')->name('periodes.update');
            Route::delete('/delete/{id}', 'destroy')->name('periodes.destroy');
        });

        Route::prefix('niveaux')->controller(\App\Http\Controllers\Admin\NiveauController::class)->group(function () {
            Route::get('/', 'index')->name('niveaux.index');
            Route::post('/store', 'store')->name('niveaux.store');
            Route::put('/update/{id}', 'update')->name('niveaux.update');
            Route::delete('/delete/{id}', 'destroy')->name('niveaux.destroy');
        });


        Route::prefix('affectations')->controller(\App\Http\Controllers\Admin\AffectationController::class)->group(function () {
            
            Route::get('/filieres/niveaux/{id}', 'PageAffectNiveauxToFiliere')->name('affectations.PageAffectNiveauxToFiliere');
            Route::put('/AffectNiveauxToFiliere/{filiere}', 'AffectNiveauxToFiliere')->name('affectations.updateAffectNiveauxToFiliere');

            Route::get('/filieres/matieres/{fid}/{sid}', 'PageAffectMatieresToFiliereByPeriode')->name('affectations.PageAffectMatieresToFiliereByPeriode');
            Route::post('/filieres/matieres/store', 'AffectMatieresToFiliereByPeriode')->name('affectations.AffectMatieresToFiliereByPeriode');
            
            Route::prefix('matieres')->controller(\App\Models\Matiere::class)->group(function() {
                Route::put('/update/{id}', 'update')->name('matieres.update');
                Route::delete('/delete/{id}', 'destroy')->name('matieres.destroy');
            });

        });




    });


    // Route::prefix('/programmes')->controller(ProgrammeController::class)->group(function () {
    //     // Index routes
    //     Route::get('/niveaux', 'indexNiveau')->name('programmes.indexNiveau');
    //     Route::get('/filieres', 'indexFiliere')->name('programmes.indexFiliere');
    //     Route::get('/periodes', 'indexPeriode')->name('programmes.indexPeriode');
    //     Route::get('/classes', 'indexClasse')->name('programmes.indexClasse');



    //     // Store routes
    //     Route::post('/niveaux/store', 'storeNiveau')->name('programmes.storeNiveau');
    //     Route::post('/filieres/store', 'storeFiliere')->name('programmes.storeFiliere');
    //     Route::post('/periodes/store', 'storePeriode')->name('programmes.storePeriode');
    //     // Route::post('/matieres/store', 'storeMatiere')->name('programmes.storeMatiere');
    //     Route::post('/classes/store', 'storeClasse')->name('programmes.storeClasse');

    //     // Show routes
    //     Route::get('/filieres/{id}', 'showFiliere')->name('programmes.showFiliere');

    //     // Update routes
    //     Route::put('/niveaux/update/{id}', 'updateNiveau')->name('programmes.updateNiveau');
    //     Route::put('/filieres/update/{id}', 'updateFiliere')->name('programmes.updateFiliere');
    //     Route::put('/periodes/update/{id}', 'updatePeriode')->name('programmes.updatePeriode');
    //     Route::put('/classes/update/{id}', 'updateClasse')->name('programmes.updateClasse');

    //     // Delete routes
    //     Route::delete('/niveaux/delete/{id}', 'destroyNiveau')->name('programmes.destroyNiveau');
    //     Route::delete('/filieres/delete/{id}', 'destroyFiliere')->name('programmes.destroyFiliere');
    //     Route::delete('/periodes/delete/{id}', 'destroyPeriode')->name('programmes.destroyPeriode');
    //     Route::delete('/classes/delete/{id}', 'destroyClasse')->name('programmes.destroyClasse');

    //     Route::prefix('affectations')->group(function () {
            
    //         Route::get('/filieres/niveaux/{id}', 'indexNiveauxFiliere')->name('programmes.indexNiveauxFiliere');
    //         Route::put('/AffectNiveauxToFiliere/{filiere}', 'AffectNiveauxToFiliere')->name('programmes.updateAffectNiveauxToFiliere');

    //         Route::get('/filieres/matieres/{fid}/{sid}', 'createMatieresToFiliere')->name('programmes.createMatieresToFiliere');
    //         Route::post('/storeMatiere', 'AffectMatieresToFiliere')->name('programmes.AffectMatieresToFiliere');
    //         Route::put('/matieres/update/{id}', 'updateMatiere')->name('programmes.updateMatiere');
    //         Route::delete('/matieres/delete/{id}', 'destroyMatiere')->name('programmes.destroyMatiere');

    //     });
        
    // });
    

    // Route::prefix('/enseignants')->controller(EnseignantController::class)->group(function () {
    //     Route::get('/', 'index')->name('enseignants.index');
    //     Route::get('/create', 'create')->name('enseignants.create');
    //     Route::post('/store', 'store')->name('enseignants.store');
    //     Route::get('/edit/{id}', 'edit')->name('enseignants.edit');
    //     Route::put('/update/{id}', 'update')->name('enseignants.update');
    //     Route::delete('/delete/{id}', 'destroy')->name('enseignants.destroy');
    //     Route::get('/matieres/{id}', 'pageAffectMatieres')->name('enseignants.matieres');
    // });

    // Route::prefix('/etudiants')->controller(EtudiantController::class)->group(function () {
    //     Route::get('/', 'index')->name('etudiants.index');
    //     Route::get('/create', 'create')->name('etudiants.create');
    //     Route::post('/store', 'store')->name('etudiants.store');
    //     Route::get('/edit/{id}', 'edit')->name('etudiants.edit');
    //     Route::put('/update/{id}', 'update')->name('etudiants.update');
    //     Route::delete('/delete/{id}', 'destroy')->name('etudiants.destroy');
    // });
});

require __DIR__.'/auth.php';