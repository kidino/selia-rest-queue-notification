<?php

use App\Models\User;
use App\Mail\HappyBirthday;
use App\Models\StreamedNotification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\Chinook\MainController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Chinook\AlbumController;
use App\Http\Controllers\Chinook\TrackController;
use App\Http\Controllers\Chinook\CustomerController;
use App\Http\Controllers\Chinook\EmployeeController;
use App\Http\Controllers\VacancyApplicationController;
use App\Http\Controllers\VehicleRegistrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->name('user.')->group(function(){

    // user listing
    Route::get('user',[UserController::class,'index'
    ])->name('index');

    // new user form
    Route::get('user/create',[UserController::class,'create'
    ])->name('create');

    // process new user form data
    Route::post('user',[UserController::class,'store'
    ])->name('store');

    Route::get('user/{user}/edit',[UserController::class,'edit'
    ])->name('edit');

   Route::patch('user/{user}',[UserController::class,'update'
   ])->name('update');
});


// Route::middleware('auth')->name('role.')->group(function(){

    // // Roles listing
    // Route::get('/role',[RoleController::class,'index'])->name('index');

    // // new role form
    // Route::get('/role/create',[RoleController::class,'create'])->name('create');

    // // process new role form data
    // Route::post('/role',[RoleController ::class,'store'])->name('store');

    // // process new role form data
    // Route::get('/role/{role}/edit', [RoleController::class, 'edit'])->name('edit');


// });

Route::resource('role',RoleController::class)->middleware('auth');

Route::resource('note',NoteController::class)->middleware('auth');

Route::resource('demo', DemoController::class);

Route::resource('assets', AssetController::class);

Route::view('test-login', 'layouts.test-login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('/profile/token/generate', [ProfileController::class, 'generateToken'])
    ->name('profile.token.generate');

    Route::delete('/profile/token/delete', [ProfileController::class, 'deleteToken'])
    ->name('profile.token.delete');

});


Route::get('/send-birthday-email/{user}', function(User $user){

    Mail::to($user->email)->send(new HappyBirthday($user));

    return response()->json([
        'message' => "Happy Birthday email sent to {$user->name}!",
        'email' => $user->email
    ]);

}); 

Route::get('/vehicle-registration/upload',
[ VehicleRegistrationController::class, 'create' ])
->name('vehicle-registrations.create');

Route::post('/vehicle-registration/upload',
[ VehicleRegistrationController::class, 'store' ])
->name('vehicle-registrations.store');


Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::get('/sse/notifications', function(){

    return response()->stream(function(){
        echo "status: connected\n";
        ob_flush();
        flush();

        if(auth()->check()) {
            $user = auth()->user();
            while(true) {

                echo "retry: 3000\n";

                // Fetch the latest unread notification that hasn't been streamed yet
                $notification = $user->unreadNotifications()
                    ->whereNotIn('id', StreamedNotification::where('user_id', $user->id)->pluck('notification_id'))
                    ->latest()
                    ->first();

                if ($notification) {

                    $unreadCount = $user->unreadNotifications()->count();

                    $stream_data = "data: " . json_encode([
                        'id' => $notification->id,
                        'message' => $notification->data['message'],
                        'url' => $notification->data['url'] ?? '#',
                        'unread_count' => $unreadCount,
                    ]) . "\n\n";

                    echo "event: new_notification\n";
                    echo $stream_data;

                    // Add the notification ID to the streamed_notifications table
                    StreamedNotification::create([
                        'user_id' => $user->id,
                        'notification_id' => $notification->id,
                    ]);
                }

                ob_flush();
                flush();
                sleep(3); // Delay to prevent overwhelming the server

            }
        }
    }, 
    200,
    [
        'Content-Type' => 'text/event-stream',
        'Cache-Control' => 'no-cache',
        'Connection' => 'keep-alive',
    ]);

})->middleware(['auth']);

Route::middleware(['auth', 'can:is-admin'])->group(function () {
    Route::resource('vacancies', VacancyController::class)->except(['destroy']);
    Route::get('vacancies/{vacancy}/applications', [VacancyApplicationController::class, 'index'])->name('vacancies.applications.index');
});

//---- Chinook 

Route::get('/chinook', [MainController::class, 'index'])
    ->middleware(['auth'])
    ->name('chinook.main');

Route::get('/chinook/employee1', [EmployeeController::class, 'employee1'])
    ->middleware(['auth'])
    ->name('chinook.employee.nplus1.bad');

Route::get('/chinook/employee2', [EmployeeController::class, 'employee2'])
    ->middleware(['auth'])
    ->name('chinook.employee.nplus1.fixed');

    Route::get('/chinook/customer1', [CustomerController::class, 'index1'])
    ->middleware(['auth'])
    ->name('chinook.customer.index1');

    Route::get('/chinook/customer2', [CustomerController::class, 'index2'])
    ->middleware(['auth'])
    ->name('chinook.customer.index2');
    
    Route::get('/chinook/albums1', [AlbumController::class, 'index1'])
    ->middleware(['auth'])
    ->name('chinook.album.index1');

    Route::get('/chinook/albums2', [AlbumController::class, 'index2'])
    ->middleware(['auth'])
    ->name('chinook.album.index2');

    Route::get('/chinook/albums3', [AlbumController::class, 'index3'])
    ->middleware(['auth'])
    ->name('chinook.album.index3');

    Route::get('/chinook/tracks1', [TrackController::class, 'allColumns'])
    ->middleware(['auth'])
    ->name('chinook.tracks.all_columns');

    Route::get('/chinook/tracks2', [TrackController::class, 'selectedColumns'])
    ->middleware(['auth'])
    ->name('chinook.tracks.selected_columns');


    Route::get('/users-datatable', [UserController::class, 'datatable'])->name('users.datatatable');


require __DIR__.'/auth.php';
