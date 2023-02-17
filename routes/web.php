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


// read

Route::get('read', function () {
    $post = Post::findOrFail(1);
    $video = Video::findOrFail(1);

    foreach ($post->tags as $tag) {
        echo 'post    ' . $tag->name;
    }

    echo '<br>';
    echo '<br>';
    echo '<br>';

    foreach ($video->tags as $tag) {
        echo 'video    ' . $tag->name;
    }
});


// update

Route::get('update', function () {
    $post = Post::findOrFail(1);
    $video = Video::findOrFail(1);

    foreach ($post->tags as $tag) {
        $tag->whereName('tag 1')->update(['name' => 'TAG-1']);
    }

    foreach ($video->tags as $tag) {
        $tag->whereName('tag 2')->update(['name' => 'TAG-2']);
    }

    $tag = Tag::findOrFail(2);

    // $post->tags()->save($tag);
    // $post->tags()->attach($tag);

    // sync basically only keeps the tags that are passed by the array
    // so if the post was having multiple tags like 1, 2, 4, ...
    // but after the following piece of code the tag will be only 1
    $post->tags()->sync([1]);
});



// delete

Route::get('delete', function () {
    $post = Post::findOrFail(1);

    // only deletes the tag from the tags table
    // taggable table un changed
    foreach ($post->tags as $tag) {
        $tag->whereId(3)->delete();
    }
});
