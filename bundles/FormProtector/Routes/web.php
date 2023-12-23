<?php
use Illuminate\Support\Facades\Route;
use FormProtector\Classes\FormProtector;

Route::get('protector/form', function() {
    $formProtector = new FormProtector();
    return $formProtector->generateFormFields();
})->name('protector_form');

Route::post('protector/validate', function() {
    $formProtector = new FormProtector();
    return $formProtector->isValidCode(request('protector_hash'), request('code'));
})->name('protector_validate_code');

Route::get('protector/example', function() {
    return view('protector::example');
})->name('protector_example');
