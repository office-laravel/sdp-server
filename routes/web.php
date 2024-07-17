<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\TemporaryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Models\Member;
use Illuminate\Support\Facades\Route;


use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('print', function () {
  return view('admin.member.print');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// index
Route::get('/home', [AdminController::class, 'show']);



// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])-> prefix('admin')->group(function () {

    //Excel
    Route::post('/import', [MemberController::class, 'import'])->name('import');
    Route::get('/export', [MemberController::class, 'exportDataToCSV'])->name('export');
   

    //   /member
    Route:: prefix('member')->group(function () {

        Route::get('show', [MemberController::class, 'index']);
        Route::get('add', [MemberController::class, 'create']);
        Route::post('save', [MemberController::class, 'store'])->name('member.save');
    
        Route::get('edit/{id}', [MemberController::class, 'edit'])->name('member.edit');
        Route::post('update/{id}', [MemberController::class, 'update'])->name('member.update');

        Route::delete('delete/{id}', [MemberController::class, 'destroy'])->name('member.delete');


        Route::get('details/{id}',[MemberController::class,'details'])->name('member.details');
        
        Route::get('archive/{IDTeam}', [TemporaryController::class, 'GetArchive'])->name('archive.GetArchive');

        Route::get('print/{id}', [MemberController::class, 'print'])->name('print');


        Route::post('avilable', [MemberController::class, 'avilable_idteam'])->name('avilable');
        Route::get('avilable_add/{avilable}', [MemberController::class, 'avilable_create'])->name('avilable_add');


        Route::get('all_members', [MemberController::class, 'all_members']);



        // for code js
        Route::get('/get-specializations/{qualificationId}',[MemberController::class, 'getSpecializations']);
        
        Route::get('/get-areasm/{cityId}', [CityController::class, 'getAreaForCity']);
        Route::get('/get-streets/{areaId}', [CityController::class, 'getStreetForArea']);



        // search
        Route::post('active', [MemberController::class, 'searchForActiveMember'])->name('search-ActiveMember');
        Route::post('dis-active', [MemberController::class, 'searchForDisActiveMember'])->name('search-disActiveMember');
        Route::post('phone', [MemberController::class, 'searchByPhoneNull'])->name('search-phone');

        Route::post('team', [MemberController::class, 'searchByIDTeam'])->name('search-team');
        Route::post('name', [MemberController::class, 'searchByName'])->name('search-name');
        Route::post('lastName', [MemberController::class, 'searchByLastName'])->name('search-LastName');

        Route::post('city', [MemberController::class, 'searchByCity'])->name('search-city');
        Route::post('street', [MemberController::class, 'searchBystreet'])->name('search-Street');
        Route::post('area', [MemberController::class, 'searchByArea'])->name('search-Area');

        Route::post('qualification', [MemberController::class, 'searchByQualification'])->name('search-qualification');
        Route::post('specialization', [MemberController::class, 'searchBySpecialization'])->name('search-specialization');
        Route::post('occupation', [MemberController::class, 'searchByOccupation'])->name('search-occupation');



        //Advanced search
        Route::get('Advancedsearch', [MemberController::class, 'Advancedsearch'])->name('Advancedsearch');
        Route::get('AdvancedIndex', [MemberController::class, 'AdvancedIndex'])->name('AdvancedIndex');



        //order
        Route::get('last', [MemberController::class, 'orderBy_Last'])->name('order-last');
        Route::get('name', [MemberController::class, 'orderBy_Name'])->name('order-name');
        Route::get('lastName', [MemberController::class, 'orderBy_LastName'])->name('order-lastName');
        Route::get('team', [MemberController::class, 'orderBy_IDTeam'])->name('order-team');
        Route::get('join', [MemberController::class, 'orderBy_DateOfJoin'])->name('order-join');

    });

    //   /user  ===>  manager
   Route:: prefix('user')->group(function () {

    Route::get('show', [UserController::class, 'index']);
    Route::get('add', [UserController::class, 'create']);
    Route::post('save', [UserController::class, 'store'])->name('user.save');

    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');

    Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
  });


   //   /branch
  Route:: prefix('branch')->group(function () {

    Route::get('show', [CityController::class, 'indexBranch']);
    Route::get('add', [CityController::class, 'createBranch']);
    Route::post('save', [CityController::class, 'storeBranch'])->name('branch.save');

    Route::get('edit/{id}', [CityController::class, 'editBranch'])->name('branch.edit');
    Route::post('update/{id}', [CityController::class, 'updateBranch'])->name('branch.update');

    Route::delete('delete/{id}', [CityController::class, 'destroyBranch'])->name('branch.delete');
  });


   //   /city
  Route:: prefix('city')->group(function () {

    Route::get('show', [CityController::class, 'index']);
    Route::get('add', [CityController::class, 'create']);
    Route::post('save', [CityController::class, 'store'])->name('city.save');

    Route::get('edit/{id}', [CityController::class, 'edit'])->name('city.edit');
    Route::post('update/{id}', [CityController::class, 'update'])->name('city.update');

    Route::delete('delete/{id}', [CityController::class, 'destroy'])->name('city.delete');
  });

   //   /area
  Route:: prefix('area')->group(function () {

    Route::get('show', [CityController::class, 'indexArea']);
    Route::get('add', [CityController::class, 'createArea']);
    Route::post('save', [CityController::class, 'storeArea'])->name('area.save');

    Route::get('edit/{id}', [CityController::class, 'editArea'])->name('area.edit');
    Route::post('update/{id}', [CityController::class, 'updateArea'])->name('area.update');

    Route::delete('delete/{id}', [CityController::class, 'destroyArea'])->name('area.delete');

  });

   //   /street
   Route:: prefix('street')->group(function () {

    Route::get('show', [CityController::class, 'indexStreet']);
    Route::get('add', [CityController::class, 'createStreet']);
    Route::post('save', [CityController::class, 'storeStreet'])->name('street.save');

    Route::get('edit/{id}', [CityController::class, 'editStreet'])->name('street.edit');
    Route::post('update/{id}', [CityController::class, 'updateStreet'])->name('street.update');

    Route::delete('delete/{id}', [CityController::class, 'destroyStreet'])->name('street.delete');

  });


  //   /occupation
  Route:: prefix('occupation')->group(function () {

    Route::get('show', [OccupationController::class, 'index']);
    Route::get('add', [OccupationController::class, 'create']);
    Route::post('save', [OccupationController::class, 'store'])->name('occupation.save');

    Route::get('edit/{id}', [OccupationController::class, 'edit'])->name('occupation.edit');
    Route::post('update/{id}', [OccupationController::class, 'update'])->name('occupation.update');

    Route::delete('delete/{id}', [OccupationController::class, 'destroy'])->name('occupation.delete');
  });



   //status
   Route:: prefix('status')->group(function () {

    Route::get('show', [StatusController::class, 'index']);
    Route::get('add', [StatusController::class, 'create']);
    Route::post('save', [StatusController::class, 'store'])->name('status.save');

    Route::get('edit/{id}', [StatusController::class, 'edit'])->name('status.edit');
    Route::post('update/{id}', [StatusController::class, 'update'])->name('status.update');

    Route::delete('delete/{id}', [StatusController::class, 'destroy'])->name('status.delete');
  });

  //   /qualification
  Route:: prefix('qualification')->group(function () {

    Route::get('show', [QualificationController::class, 'indexQualification']);
    Route::get('add', [QualificationController::class, 'createQualification']);
    Route::post('save', [QualificationController::class, 'storeQualification'])->name('qualification.save');

    Route::get('edit/{id}', [QualificationController::class, 'editQualification'])->name('qualification.edit');
    Route::post('update/{id}', [QualificationController::class, 'updateQualification'])->name('qualification.update');

    Route::delete('delete/{id}', [QualificationController::class, 'destroyQualification'])->name('qualification.delete');
  });

  //   /specialization
  Route:: prefix('specialization')->group(function () {

    Route::get('show', [QualificationController::class, 'indexSpecialization']);
    Route::get('add', [QualificationController::class, 'createSpecialization']);
    Route::post('save', [QualificationController::class, 'storeSpecialization'])->name('specialization.save');

    Route::get('edit/{id}', [QualificationController::class, 'editSpecialization'])->name('specialization.edit');
    Route::post('update/{id}', [QualificationController::class, 'updateSpecialization'])->name('specialization.update');

    Route::delete('delete/{id}', [QualificationController::class, 'destroySpecialization'])->name('specialization.delete');
  });

  //   /notice
  Route:: prefix('notice')->group(function () {

    Route::get('edit', [TemporaryController::class, 'getEtidedMember'])->name('edit');
    Route::get('editDetails/{IDTeam}', [MemberController::class, 'detailsForCompare'])->name('notice.editDetails');
    Route::get('editDetailsNew/{IDTeam}', [TemporaryController::class, 'editDetails'])->name('notice.editDetailsNew');

    Route::get('delete', [TemporaryController::class, 'getDeletedMember'])->name('delete');
    
    Route::get('deleteDetails/{id}', [TemporaryController::class, 'deleteDetails'])->name('notice.deleteDetails');
    Route::get('destroyNotice_delete/{id}', [TemporaryController::class, 'destroyNotice_delete'])->name('notice.destroyNotice_delete');

    Route::get('destroyNotice/{id}', [TemporaryController::class, 'destroyNotice'])->name('notice.destroyNotice');

    Route::get('destroyNoticeUpdate/{id}', [TemporaryController::class, 'destroyNoticeUpdate'])->name('notice.destroyNoticeUpdate');

    // delete member from notice
    Route::get('destroyForNotice/{IDTeam}', [MemberController::class, 'destroyForNotice'])->name('notice.destroyForNotice');

    Route::post('updateForNotice/{IDTeam}', [MemberController::class, 'updateForNotice'])->name('notice.updateForNotice');

  });


});



// Manager Routes
Route::middleware(['auth', 'verified', 'manager'])-> prefix('manager')->group(function () {

    //Excel
    Route::get('/export', [MemberController::class, 'exportDataToCSV'])->name('exportm');


    //   /memberm
    Route:: prefix('memberm')->group(function () {

        Route::get('show', [MemberController::class, 'index']);
        Route::get('add', [MemberController::class, 'create']);
        Route::post('save', [MemberController::class, 'store'])->name('memberm.save');
    
        Route::get('edit/{id}', [MemberController::class, 'edit'])->name('memberm.edit');
        Route::post('update/{id}', [TemporaryController::class, 'storeUpdatedMember'])->name('memberm.update');

        Route::post('delete/{id}', [TemporaryController::class, 'storeDeletedMember'])->name('memberm.delete');

        Route::get('/get-specializations/{qualificationId}',[MemberController::class, 'getSpecializations']);

        Route::get('details/{id}',[MemberController::class,'details'])->name('memberm.details');


        Route::get('/get-streets/{areaId}', [CityController::class, 'getStreetForArea']);

        Route::get('print/{id}', [MemberController::class, 'print'])->name('print-m');


        // search
        Route::post('phone', [MemberController::class, 'searchByPhoneNull'])->name('search-m-phone');
        Route::post('active', [MemberController::class, 'searchForActiveMember'])->name('search-m-ActiveMember');

        Route::post('team', [MemberController::class, 'searchByIDTeam'])->name('search-m-team');
        Route::post('name', [MemberController::class, 'searchByName'])->name('search-m-name');
        Route::post('lastName', [MemberController::class, 'searchByLastName'])->name('search-m-LastName');
        
        Route::post('street', [MemberController::class, 'searchBystreet'])->name('search-m-Street');
        Route::post('area', [MemberController::class, 'searchByArea'])->name('search-m-Area');

        Route::post('qualification', [MemberController::class, 'searchByQualification'])->name('search-m-qualification');
        Route::post('specialization', [MemberController::class, 'searchBySpecialization'])->name('search-m-specialization');
        Route::post('occupation', [MemberController::class, 'searchByOccupation'])->name('search-m-occupation');


        //order
        Route::get('last', [MemberController::class, 'orderBy_Last'])->name('order-m-last');
        Route::get('name', [MemberController::class, 'orderBy_Name'])->name('order-m-name');
        Route::get('lastName', [MemberController::class, 'orderBy_LastName'])->name('order-m-lastName');
        Route::get('team', [MemberController::class, 'orderBy_IDTeam'])->name('order-m-team');
        Route::get('join', [MemberController::class, 'orderBy_DateOfJoin'])->name('order-m-join');

    });

});

// Place all other routes above this one
// Catch-all route

Route::get('/{any}', function() {
  return redirect('/');
})->where('any', '.*');


require __DIR__.'/auth.php';

