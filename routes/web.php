<?php




Route::middleware('auth')->group(function () {


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


    Route::prefix('/roles_permissions')->group(function() {
        Route::prefix('/roles')->controller(\App\Http\Controllers\RoleController::class)->group(function () {
            Route::get('/', 'index')->name('roles.index');
            Route::post('/store', 'store')->name('roles.store');
            Route::put('/update/{role}', 'update')->name('roles.update');
            Route::delete('/delete/{role}', 'destroy')->name('roles.destroy');
            Route::get('/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'PageAffectPermissionsToRole'])->name('roles.PageAffectPermissionsToRole');
            Route::post('/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'AffectPermissionsToRole'])->name('roles.AffectPermissionsToRole');
        });

        Route::prefix('/permissions')->controller(\App\Http\Controllers\PermissionController::class)->group(function () {
            Route::get('/', 'index')->name('permissions.index');
            Route::post('/store', 'store')->name('permissions.store');
            Route::put('/update/{permission}', 'update')->name('permissions.update');
            Route::delete('/delete/{permission}', 'destroy')->name('permissions.destroy');
        });
    });

    


    Route::prefix('/academique')->group(function () {

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


        Route::prefix('classes')->controller(\App\Http\Controllers\ClasseController::class)->group(function () {
            Route::get('/', 'index')->name('classes.index');
            Route::post('/store', 'store')->name('classes.store');
            Route::put('/update/{id}', 'update')->name('classes.update');
            Route::delete('/delete/{id}', 'destroy')->name('classes.destroy');
        });

    });






    Route::prefix('/parametres')->group(function () {
        
        Route::prefix('annees')->controller(\App\Http\Controllers\AnneeController::class)->group(function () {
            Route::get('/', 'index')->name('annees.index');
            Route::post('/store', 'store')->name('annees.store');
            Route::put('/update/{id}', 'update')->name('annees.update');
            Route::delete('/delete/{id}', 'destroy')->name('annees.destroy');
        });

        Route::prefix('profile')->controller(\App\Http\Controllers\ProfileController::class)->group(function () {
            Route::get('/', 'edit')->name('profile.edit');
            Route::put('/update', 'update')->name('profile.update');
            Route::put('/password', 'updatePassword')->name('profile.updatePassword');
        });


    });



});

require __DIR__.'/auth.php';