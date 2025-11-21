<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// MongoDB Test Route
Route::get('/test-db', function () {
    try {
        // Test MongoDB connection
        DB::connection('mongodb')->getMongoClient()->listDatabases();
        
        // Try to create a user (this will create the collection automatically)
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@quickkita.com',
            'password' => bcrypt('password123')
        ]);
        
        return "MongoDB connected and User created successfully! User ID: " . $user->_id;
        
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';