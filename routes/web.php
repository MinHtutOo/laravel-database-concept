<?php

use App\Models\Hacky;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
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

Route::get('/find', function () {
    $posts = Post::find(1);
    return $posts->title;
    
});

Route::get('/where', function () {
    $posts = Post::where('is_admin',0)->take(1)->get();
    return $posts;
});

Route::get('/insert', function () {
    $posts = new Post();
    $posts->title = "PHP-Advanced";
    $posts->content = "Tutorial by Waifer";
    $posts->save();
});

Route::get("/all", function () {
    $posts = Post::all();
    return $posts;
});

// Route::get("/update", function () {
//     $posts = Post::find(2);

//     $posts->title = "PHP-Intermediate";
//     $posts->content = "Tutorial by Waifer";

//     $posts->save();
// });

Route::get("/update", function () {
    Post::where('id',2)->where('is_admin',0)->update(['title'=> 'PHP']);
});

Route::get("/create", function () {
    Post::create(['title'=>'PHP OOP','content'=> 'Tutorial by Jonathan']); // mass insertion
});

Route::get('/delete', function () {
    // $post = Post::find(1);
    // $post->delete();

    // Post::destroy(1);

    Post::destroy([1,2,3]);
});

Route::get('/softdelete', function () {
    $post = Post::find(6);
    $post->delete();
});

Route::get('/findSoftdelete', function () {
    // $post = Post::withTrashed()->where('id',6)->get();
    $post = Post::onlyTrashed()->where('id',5)->get();
    return $post;
});

Route::get('/restore', function () {
    $post = Post::onlyTrashed()->where('is_admin',0)->restore();
});

Route::get('forcedelete', function () {
    $post = Post::onlyTrashed()->where('id',6)->forceDelete();
});

/* CRUD using Model
Route::get('/getall', function () {
    $posts = Post::all();
    foreach( $posts as $post ) {
    return $post->title;
    }
});

Route::get('/geth', function () {
    $hack = Hacky::all();
    foreach( $hack as $h ) {
        echo $h->title . "<br>";
    }
});

Route::get("/insert", function () {
    DB::insert('insert into hackies (title,content) values (?,?)',['Hacking 3','Cross Site Forgery']);
});
*/


/* normal post crud
Route::get('/insert', function () {
    // DB::insert('insert into posts(title,content) values (?,?)',['Laravel','Tutorial by Waiferkolar']);
    DB::insert('insert into posts (title,content) values (?,?)',['PHP','Tutoriall by Waiferkolar']);
});

Route::get('/read', function () {
    $result = DB::select('select * from posts where is_admin=?',[0]);
    $var = "";
    foreach ($result as $post) {
        $var .= $post->title . '<br>' . $post->content .'<br>';
    }
    return $var;
});

Route::get('/update', function () {
    $answer = DB::update('update posts set title=? where id=?',['Laravel 10','1']);
    return $answer;
});

Route::get('/delete/{id}', function ($id) {
    $answer = DB::delete('delete from posts where id=?',[$id]);
    return $answer;
});
*/
