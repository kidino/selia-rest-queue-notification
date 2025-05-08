<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Log;
use App\Models\Scopes\UserNoteScope;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserUpdatedByAdmin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{

    use AuthorizesRequests;

    public function __construct() {
        $this->authorizeResource(User::class, 'user');
    }    

    public function index() {

        // $users = User::with('roles')->withCount('notes')->paginate(10);

        // to override Scope Rule
        $users = User::with('roles')
        ->withCount(['notes' => function ($query) {
            $query->withoutGlobalScope(UserNoteScope::class); 
        }])
        ->paginate(10);

        return view('user.index', compact('users'));
    }

    public function create() {

        return view('user.create');
    }

    public function store(Request $request) {

        // dd( $request->all() );

        $request->validate([
            'name' => 'required|min:5|max:255|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:4|regex:/[0-9]/|regex:/[a-z]/|regex:/[A-Z]/',
        ]);

        // save to users table
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make( $request->password )
        ]);

        return redirect( route('user.index') )->with('success', 'User created successfully.');
    }

    //  Get user data by id and pass it to the view
    public function edit(User $user) {
        $roles = Role::all();

        return view('user.edit', compact('user','roles'));
    }

    //  POST user data to the server and update the user data.
    public function update(Request $request, User $user) {

        $request->validate([
            'name' => 'required|min:5|max:255|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|confirmed|min:4|regex:/[0-9]/|regex:/[a-z]/|regex:/[A-Z]/',
        ]);

        $changedFields = [];
        if ($user->name !== $request->name) $changedFields[] = 'name';
        if ($user->email !== $request->email) $changedFields[] = 'email';
        if ($request->password) $changedFields[] = 'password';           

        $user->name = $request->name;
        $user->email = $request->email;

        if( $request->password ) {
            $user->password = Hash::make( $request->password );
        }

        $user->save();

        $oldRoleNames = $user->roles->pluck('name')->toArray();

        $newRoleIds = $request->roles ?? [];
        $user->roles()->sync($newRoleIds);
        $user->load('roles');

        $newRoleNames = $user->roles->pluck('name')->toArray();

        if ($oldRoleNames !== $newRoleNames) {
            $changedFields[] = 'roles';
        }  

        // Send email notification
        if (!empty($changedFields)) {
            $user->notify(new UserUpdatedByAdmin($changedFields, $newRoleNames));
        }            

        return redirect( route('user.index') )->with('success', 'User updated successfully.');

    }

    
    public function datatable(UsersDataTable $dataTable)
    {
        return $dataTable->render('user.datatable');
    }

}
