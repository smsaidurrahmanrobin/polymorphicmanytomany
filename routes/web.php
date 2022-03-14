<?php

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function (){

    $post = Post::create(['name'=>'First Post']);
    $tag1 = Tag::find(1);

    $post->tags()->save($tag1);

    $video = Video::create(['name'=>'video.mov']);
    $tag2 = Tag::find(2);
    $video->tags()->save($tag2);
});

Route::get('/read', function (){

    $post = Post::findorfail(1);

    foreach ($post->tags as $tag){

        echo $tag;

    }
});

//Two-way's of updating data------------------------

Route::get('/update1', function (){

    $post = Post::findorfail(1);

    foreach ($post->tags as $tag){

       return $tag->whereName('php')->update(['name'=>'Updated php']);

    }
});

Route::get('/update2', function (){

    $post = Post::findorfail(1);

    $tag = Tag::find(2);

    $post->tags()->save($tag);

});

//------Attach----------

Route::get('/attach', function (){

    $post = Post::findorfail(1);

    $tag = Tag::find(3);

    $post->tags()->attach($tag);

});

Route::get('/sync', function (){

    $post = Post::findorfail(1);

    $tag = Tag::find(3);

    $post->tags()->sync([1,2]);

});

Route::get('/delete', function (){

    $post = Post::findorfail(1);

    foreach ($post->tags as $tag){

        $tag->delete();

    }

});
