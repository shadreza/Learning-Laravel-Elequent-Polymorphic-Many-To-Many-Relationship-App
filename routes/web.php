<?php

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use App\Models\Taggable;
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




/*
|--------------------------------------------------------------------------
| CRUD
|--------------------------------------------------------------------------
*/


// create
// when any tag is tagged to any content [video / post] -> taggable table will be populated as that is the pivot table

Route::get('create', function () {
    $post = Post::create(['name' => 'Post 1']);
    $tag = Tag::findOrFail(1);
    $post->tags()->save($tag);

    $video = Video::create(['name' => 'Video 1']);
    $tag = Tag::findOrFail(2);
    $video->tags()->save($tag);
});
