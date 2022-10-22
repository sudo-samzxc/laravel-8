<?php

use Illuminate\Support\Facades\Route;
use App\Models\Staff;
use App\Models\Photo;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create/staff/{id}/photo', function ($id) {
    $staff = Staff::find($id);
    $staff->photos()->create(['path' => 'example.jpg']);
    
});

Route::get('/read/staff/{id}/photo', function ($id) {
    $staff = Staff::find($id);
    return $staff->photos;    
});

Route::get('/update/staff/{id}/photo', function ($id) {
    $staff = Staff::find($id);

    $photo = $staff->photos()->whereId(1)->first();

    $photo->path = 'updated.jpg';

    $photo->save();
});

Route::get('/delete/staff/{id}/photo', function ($id) {
    $staff = Staff::findOrFail($id);
    $staff->photos()->where('path', 'example.jpg')->delete();

    return 'Success';
});

Route::get('/assign/staff/{staff_id}/photo/{photo_id}', function($staff_id, $photo_id) {
    $staff = Staff::findOrFail($staff_id);
    $photo = Photo::findOrFail($photo_id);

    $staff->photos()->save($photo);

});

Route::get('/unassign/staff/{staff_id}/photo/{photo_id}', function($staff_id, $photo_id) {
    $staff = Staff::findOrFail($staff_id);
    
    $staff->photos()->whereId($photo_id)->update(['imageable_id' => '0', 'imageable_type' => '']);
});