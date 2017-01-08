<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $users = User::all();

        return view('admin.users.index')->with(compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit')->with(compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ]
        ]);

        $user->update(['name' => $request->name, 'email' => $request->email]);

        $this->flasher->success('User updated', 'User info was successfully updated');

        return redirect('admin/users');
    }

    public function delete(User $user)
    {
        $user->delete();

        $this->flasher->success('User Deleted', 'That user was successfully removed from the system');

        return redirect('/admin/users');
    }
}
