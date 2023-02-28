<?php

Route::group(['namespace' => 'Front', 'middleware' => 'locale'], function () {

    Route::get('/','FrontController@index')->name('front.home_page');
    Route::get('/blogs','FrontController@posts')->name('front.posts');
    Route::get('{categorySlug}/{slug}', 'FrontController@getPost')->name('front.getPost');
    Route::get('/load-more-post','FrontController@loadMorePost')->name('front.loadmore.post');
    Route::post('/send-contact','FrontController@sendContact')->name('send.contact');


    Route::get('/reset','FrontController@reset');



});



