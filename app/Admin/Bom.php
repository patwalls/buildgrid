<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */

Admin::model('BuildGrid\Bom')->title('Boms')->display(function ()
{
	$display = AdminDisplay::datatables();
	$display->columns([
        Column::string('project.user.full_name')->label('Owner'),
        Column::string('project.name')->label('Project'),
        Column::string('name')->label('Name'),
        Column::count('invitedSuppliers')->label('Invited Suppliers'),
        Column::datetime('created_at')->label('Created At')->format('D, F d, Y'),
	]);
	return $display;
});
