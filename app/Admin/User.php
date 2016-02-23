<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */

Admin::model('BuildGrid\User')->title('Users')->display(function ()
{
	$display = AdminDisplay::datatables();
	$display->columns([
		Column::string('full_name')->label('Name'),
		Column::string('email')->label('Email'),
        Column::datetime('created_at')->label('Registered On')->format('D, F d, Y'),
	]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('first_name', 'First Name')->required(),
        FormItem::text('last_name', 'Last Name')->required(),
		FormItem::text('email', 'Email')->required()->unique(),
	]);
	return $form;
});
