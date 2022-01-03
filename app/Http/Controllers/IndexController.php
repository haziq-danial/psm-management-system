<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user = User::with('roles')->find(Auth::id());

        if ($user->hasRole(['student', 'supervisor']))
        {
            return redirect()->route('manage-title.view');
        }

        if ($user->hasRole('coordinator'))
        {
            return redirect()->route('manage-proposal.view-all');
        }

        if ($user->hasRole('technician')) {
            return redirect()->route('manage-inventory.view-all');
        }
    }
}
