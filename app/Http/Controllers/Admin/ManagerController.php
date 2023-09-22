<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\ManagerCreateRequest;
use App\Http\Requests\Manager\ManagerUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = User::all();
        return view('admin.manager.index', compact('managers'));
    }

    public function create()
    {
        return view('admin.manager.create');
    }

    public function store(ManagerCreateRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('manager.index')->with('alert', trans('alerts.managers.created'));
    }

    public function edit(User $manager)
    {
        return view('admin.manager.edit', compact('manager'));
    }

    public function update(ManagerUpdateRequest $request, string $id)
    {

        $user = User::findOrFail($id);
        $user->update($request->validated());
        return redirect()->route('manager.index')->with('alert', trans('alerts.managers.password_changed'));
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('manager.index')->with('alert', trans('alerts.managers.deleted'));
    }
}
