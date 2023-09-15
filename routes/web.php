<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\VotersController;
use App\Http\Middleware\EnsureTokenIsValid;
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
    return view('welcome_home');
})->name('welcome');

// authentication pages routes
Route::get('/AdminLogin', function () {
    return view('authentication.admin_login');
})->name('loginAdmin');

Route::get('/UserLogin', function () {
    return view('authentication.user_login');
})->name('loginUser');

// authentication functions
Route::post('/loginAdmin', [AuthenticationController::class, 'admin_login'])->name('adminLogin');
Route::delete('/logoutAdmin', [AuthenticationController::class, 'admin_logout'])->name('adminLogout');

Route::post('/loginUser', [AuthenticationController::class, 'voter_login'])->name('voterLogin');
Route::delete('/logoutUser', [AuthenticationController::class, 'voter_out'])->name('voterLogout');

// login users can access
Route::prefix('Admin')->middleware('auth')->group(function () {
    // dashboard
    Route::get('/Dashboard', [ResultsController::class, 'dashboard'])->name('admin_dashboard');

    // candidate
    Route::resource('Candidates', CandidatesController::class);

    // voters
    Route::resource('Voters', VotersController::class);
    Route::any('Voters', [VotersController::class, 'index'])->name('voter-index');

    // vote results
    Route::get('/votingResults', [ResultsController::class, 'voting_results'])->name('results');

    // pdf routes
    Route::get('/resultsPDF', [ResultsController::class, 'results_pdf'])->name('results_pdf');

    Route::any('/votersListPDF', [ResultsController::class, 'voters_pdf'])->name('voters_pdf');
});


// for the users who's going to vote
Route::middleware('authVoter')->group(function () {
    // voting cadidates
    Route::get('/votingCandidates', [VotersController::class, 'vote_candidates'])->middleware('hasVoted')->name('voteCandidate');
    Route::post('/submitVotes', [VotersController::class, 'store_votes'])->name('submitVotes');

    // extra routes
    Route::post('/postToGo', function () {
        return view('voter.results');
    });

    // thank you message
    Route::get('/Thankyou', function () {
        return view('extra_pages.thank_you_page');
    });
});
