<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    public function index(): View
    {
        $professors = User::where('is_admin', true)->orderBy('name')->get();

        return view('admin.index')->with('professors', $professors);
    }

    public function addProfessor(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::firstWhere('email', $request->get('email'));
        if ($user == null)
            return redirect()->back()->withErrors('This user could not be found! Make sure they have signed into the platform at least once.');

        $user->is_admin = true;
        $user->save();

        return redirect()->back();
    }

    public function removeProfessor(Request $request, User $user): RedirectResponse
    {
        $user->is_admin = false;
        $user->is_sys_admin = false;
        $user->save();

        return redirect()->back();
    }

    public function togglePromotion(Request $request, User $user): RedirectResponse
    {
        $user->is_sys_admin = ! $user->is_sys_admin;
        $user->save();

        return redirect()->back();
    }
}
