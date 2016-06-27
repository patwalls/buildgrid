<?php

namespace BuildGrid\Http\Controllers;


use BuildGrid\Bom;
use BuildGrid\BomResponse;
use BuildGrid\InvitedSupplier;
use Illuminate\Support\Facades\View;
use \BuildGrid\User;

class AdminController extends Controller
{
    public function index()
    {
        // Dashboard Stats

        $new_users = User::whereBetween('created_at', [\Date::now()->subDays(15),\Date::now()] )->count();
        $new_boms  = Bom::whereBetween('created_at', [\Date::now()->subDays(15),\Date::now()] )->count();
        $invited_suppliers = InvitedSupplier::whereBetween('created_at', [\Date::now()->subDays(15),\Date::now()] )->count();
        $bom_responses = BomResponse::whereBetween('created_at', [\Date::now()->subDays(15),\Date::now()] )->count();
        $accepted_responses = BomResponse::where('status', 'accepted')->whereBetween('created_at', [\Date::now()->subDays(15),\Date::now()] )->count();

        return View::make('admin.dashboard', compact('new_users', 'new_boms', 'invited_suppliers', 'bom_responses', 'accepted_responses'));
    }


}
