<?php

Route::get('', [
	'as' => 'admin.home',
	function ()
	{
		$content = '';
		return Admin::view($content, 'Dashboard');
	}
]);


Route::get('files', function() {
        $content = View::make('admin.files');
        return Admin::view($content, 'Dashboard');
    }
);
