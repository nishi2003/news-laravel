use App\Http\Controllers\Api\NewsController;

Route::get('/news/list', [NewsController::class, 'list']);
Route::get('/news/{id}', [NewsController::class, 'show']);
