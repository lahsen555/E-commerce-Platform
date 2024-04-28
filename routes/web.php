<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SignaleController;
use App\Models\Product;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Statistic;
use App\Models\Category;
use App\Models\City;

// use Nette\Utils\Json;
// use Chatify\ChatifyMessenger;

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

// Route::get('/', function (Request $request) {
//     $productController = new \App\Http\Controllers\ProductController;
//     $products = $productController->getAllProducts();
//     // return view('welcome', ['products' => $products]);

//     if ($request->filled('search')) {
//         $products = Product::search($request->search)->get(); // search by value
//         return view('welcome', compact('products'));
//     }

//     return view('welcome', ['products' => $products]);// list 10 ro

// });

Route::get('/', [ProductController::class, 'index1']);
Route::get('/search', [ProductController::class, 'search']);



Route::get("/comment.index" , function(Request $request){
    $pro = $request['pro'];
    $comments = Comment::where('product_id', $pro);
    return view('pro', ['comm'=>$comments]);
})->name('ind');


Route::get('/dashboard', function () {
    $usid = Auth::user()->id;

    $stat = DB::table('statistics')
            ->where('user_id', $usid)
            ->get();

    if($stat->count() == 0){
                $stat = new Statistic();
        
                $stat->user_id = $usid;
                $stat->pronum = 0;
                $stat->made = 0;
        
                $stat->save();
     }
     $stat = DB::table('statistics')
            ->where('user_id', $usid)
            ->first();
    return view('dashboard', ['stat' => $stat]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/pro', function(Product $pro){
    $comments = Comment::all();
    return view('pro', ['pro'=>$pro, 'comments' => $comments]);
})->name('pro');



 
Route::get('/botic', function(Request $request){
    $id = $request['id'];
    $products = Product::where('user_id', $id)->get();
    return view('botic', ['id' => $id, 'products' => $products]);
})->name('botic');

Route::post('/profile.partials.interests',function(Request $request)
{
    $user = Auth::user();
    
    $user->cities()->sync($request->input('cities'));
    $user->categories()->sync($request->input('categories'));

    

    return redirect()->back();
})->name('save_categories');
  
Route::resource('product', ProductController::class)
    ->only(['create', 'store', 'index', 'show', 'update']);


Route::get('/liked', function(){
    return view('liked');
})->name('liked');



Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
// Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/admin/users/{id}/make-admin', [AdminController::class, 'makeAdmin'])->name('admin.users.make-admin');
    Route::delete('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin.tables', [AdminController::class, 'tables'])->name('admin.tables');
    Route::get('/admin.edit', [ProfileController::class, 'edit'])->name('admin.edit');
    Route::get('/admin.sina/{id}', [AdminController::class, 'sina'])->name('admin.sina');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('like', 'App\Http\Controllers\LikeController@like')->name('like');
    Route::post('/pro', 'App\Http\Controllers\CommentController@store')->name('comments.store');
    Route::delete('like', 'App\Http\Controllers\LikeController@unlike')->name('unlike');
    Route::get('/signale/create/{id}', [SignaleController::class, 'create'])->name('signale.create');
    Route::post('/signale.create', [SignaleController::class, 'store'])->name('signale.store');
});



// Route::middleware('auth')->group(function () {
//     Route::post('like', 'LikeController@like')->name('like');
//     Route::delete('like', 'LikeController@unlike')->name('unlike');
// });

require __DIR__.'/auth.php';

// we are comming back soone to hadle you and then we will see 
// yes we are back what was our error i think it was the handling of the admin stuff 

