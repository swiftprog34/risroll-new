<?php

namespace App\Http\Controllers\Admin;

use App\Enums\User\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\ManagerCreateRequest;
use App\Http\Requests\Manager\ManagerUpdateRequest;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = User::with('cities')->get();
        return view('admin.manager.index', compact('managers'));
    }

    public function create()
    {
        $roles = collect(Role::toArray());
        $cities = City::orderBy('city_name')->pluck('city_name', 'id');
        return view('admin.manager.create', compact('cities', 'roles'));
    }

    public function store(ManagerCreateRequest $request)
    {
        $user = User::make([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        DB::transaction(function() use ($request, $user) {

            $user->save();
            $user->cities()->sync($request->city);
        });

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
