<?php

$UserObject = resolve('User');

// Route::get('/adminTest', function () {

// return view('bark_admin.index');
// });

Route::get('/back', 'StructureController@back') -> name('back');

Route::post('/login/users', 'Admin\UserController@loginUser')->name('login.users'); 

Route::group(['middleware' => ['auth', 'role:' . $UserObject->getAdminValue()]], function () {
    
    Route::post('/search/users', 'Admin\UserController@search_users')->name('search.users'); 
    Route::post('/search/admin', 'Admin\UserController@search_admin')->name('search.admin'); 

    //==========================================================================================================================
    //
    //  add users
    //
    //==========================================================================================================================
    Route::get('/admin/panel', 'Admin\UserController@adminPanel')->name('adminPanel'); 

    Route::get('/manage/admins', 'Admin\UserController@addDataEntry')->name('addDataEntry'); 

    Route::get('/admins', 'Admin\UserController@getDataEntry')->name('getDataEntry'); 

    Route::get('/users', 'Admin\UserController@index')->name('user.index'); 
    // create data entry 
    Route::get('/create/admin/uesr/', 'Admin\UserController@create')->name('user.create'); 

    Route::get('/add/uesr/', 'Admin\UserController@show')->name('user.show');

    Route::post('/store/admin/uesr/', 'Admin\UserController@store')->name('user.add');

    Route::get('/edit/admin/{editUser}', 'Admin\UserController@edit')->name('user.edit');

    Route::put('/update/admin/{editUser}', 'Admin\UserController@update')->name('user.update');

    Route::get('user/delete/{editUser}', 'Admin\UserController@destroy')->name('user.delete');

    //==========================================================================================================================
    //
    //  placement test
    //
    //==========================================================================================================================

    Route::get('placement/test'              ,'Admin\PlacementTestController@index')->name('placement.test');
    Route::get('placementTest'               ,'Admin\PlacementTestController@create')->name('placementtest');
    Route::post('placement/test/add'         ,'Admin\PlacementTestController@addPlacementTest')->name('add');
    Route::get('placement/test/{id}/edit/'   ,'Admin\PlacementTestController@editPlacementTest')->name('edit.placement.test');
    Route::put('placement/test/{id}/update/' ,'Admin\PlacementTestController@updatePlacementTest')->name('update.placement.test');
    Route::get('placement/test/{id}/delete'  ,'Admin\PlacementTestController@deletePlacementTest') ->name('placement.test.delete');


    //==========================================================================================================================
    //
    //  display levels , units and lessons
    //
    //==========================================================================================================================
    
    
    Route::get('display/levels', 'LevelController@display')->name('display.levels');
    Route::get('display/units/{level}', 'UnitController@display')->name('display.units');
    Route::get('display/lessons/{unit}', 'LessonController@display')->name('display.lessons');
    


    //==========================================================================================================================
    //
    //  add and edit levels , units and levels
    //
    //==========================================================================================================================

    
    Route::pattern('parentId', '[0-9]+');

    Route::get('/structureCreate', 'StructureController@index')->name('structure.index');

    // create
    Route::get('/structureCreate/{structureType?}/{parentId?}', 'StructureController@create')->where('structureType', 'beginnerLevel|level|unit|lesson');

    // edit
    Route::get('/edit/{structureType}/{structure}/{parentId?}', 'StructureController@edit')->where('structureType', 'beginnerLevel|level|unit|lesson');

    // add
    Route::post('/structureSave/{structureType}', 'StructureController@store')->where('structureType', 'beginnerLevel|level|unit|lesson');

    // update
    Route::patch('structureCreate/{structure}/update', 'StructureController@update')->name('update.structure');

    //delete
    Route::get('structure/{structure}/delete', ['as' => 'structure.delete', 'uses' => 'StructureController@destroy']);
   
    // lesson structure 
    Route::get('topic/type/{Lesson}/{key?}', 'LessonStructureController@create')->name('topic.type');

    // create
    // Route::get('create/lesson/{Lesson}/{key}', 'LessonStructureController@create')->name('lesson.create');

    // add 
    Route::post('store/lesson/{lesson_id}/{key?}', 'LessonStructureController@store')->name('lesson.store');
    
    Route::get('lesson/content/{lesson}', 'Admin\LessonController@lesson_content')->name('lesson.content');
    
    Route::get('lesson/{content}/delete', ['as' => 'lesson.delete', 'uses' => 'Admin\LessonController@destroy']);
    

    //==========================================================================================================================
    //
    //  add and edit levels , units and levels
    //
    //==========================================================================================================================


    // school
    Route::get('schools', 'Admin\SchoolController@index')->name('schools');
    Route::get('create/school', 'Admin\SchoolController@create')->name('school');
    Route::post('add/school', 'Admin\SchoolController@store')->name('add.school');
    Route::get('edit/school/{school}', 'Admin\SchoolController@edit')->name('edit.school');
    Route::post('update/school/{school}', 'Admin\SchoolController@update')->name('update.school');
    Route::get('school/{school}/delete',  'Admin\SchoolController@destroy') ->name('school.delete');


});

    //==========================================================================================================================
    //
    //  data entry role
    //
    //==========================================================================================================================


Route::group(['middleware' => ['auth', 'role:' . $UserObject->getDataEntryValue()]], function () {

});