<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectTasksController;
use App\Http\Controllers\TransactionsController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/pdf', function () {
    $html = '<!DOCTYPE html><html><head><title></title><style> *{ font-family: roboto-1; font-size: 30px;} </style> </head><body>Textblock greek:<br id="isPasted">Greek text:<br><br>Με το παρόν σας ευχαριστούμε για τη νέα σας ανάθεση, την οποία θα επεξεργαστούμε σύμφωνα με τους Γενικούς Όρους και Προϋποθέσεις μας, όπως συμφωνήθηκαν μεταξύ μας.<br><br>Λεπτομέρειες της υπόθεσης:<br>Αριθμός υπόθεσης: <br>Όνομα και πόλη του οφειλέτη: <br>Συνολικό οφειλόμενο ποσό, συμπεριλαμβανομένων των τόκων και των προστίμων: &nbsp;<br><br>Παρακαλούμε να μας ενημερώσετε αμέσως σε περίπτωση που ο οφειλέτης καταβάλει άμεσα ποσά στο λογαριασμό σας.<br><br><br> </body></html>';

    // Generate the PDF
    $pdf = Pdf::yca($html);
    return $pdf->stream('my_pdf.pdf');
});

Route::get('/dashboard', function () {
    //test
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function() {
    Route::get('/projects', [ProjectsController::class, 'index']);
    Route::get('/projects/create', [ProjectsController::class, 'create']);
    Route::get('/projects/{project}', [ProjectsController::class, 'show']);
    Route::patch('/projects/{project}', [ProjectsController::class, 'update']);
    Route::post('/projects', [ProjectsController::class, 'store']);

    Route::post('/projects/{project}/tasks', [ProjectTasksController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [ProjectTasksController::class, 'update']);
});

Route::middleware('auth')->group(function() {
    // Route::get('/accounts', [AccountsController::class, 'index']);
    // Route::get('/categories', [AccountsController::class, 'index']);
});


// Make changes here
Route::middleware('auth')->group(function() {
    Route::get('/transactions', [TransactionsController::class, 'index']);
    Route::get('/transactions/create', [TransactionsController::class, 'create']);
    Route::get('/transactions/{transaction}', [TransactionsController::class, 'show']);
    Route::patch('/transactions/{transaction}', [TransactionsController::class, 'update']);
    Route::post('/transactions', [TransactionsController::class, 'store']);
});
