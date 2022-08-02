<?php

namespace App\Components\Clients\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Requests
use App\Components\Clients\Requests\Site\UpdateProfileRequest;
use App\Components\Clients\Requests\Site\ChangePasswordRequest;
// Models
use App\Components\Cities\Models\City;
use App\Models\User;
use Auth;
use Hash;

class ClientsController extends Controller {

    public function profile_index() {
        $user = Auth::user();
        $cities = City::all();
        return view('Clients_Site::edit',get_defined_vars());
    }

    public function profile_update(UpdateProfileRequest $request ,$user) {
        $user = User::find($user);
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']  = imageUpload($request->image, 'clients');
        }
        $user->update($data);
        return redirect()->back()->with('success', __('Data Updated Successfully'));
    }

    public function change_password_index() {
        $user = Auth::user();
        return view('Clients_Site::change_password',get_defined_vars());
    }

    public function change_password_update(ChangePasswordRequest $request ,User $user) {
        $user = Auth::user();
        if (!Hash::check($request->old_password ,$user->password)) {
            return redirect()->back()->with('error', __('Old password does not match'));
        }
        if ($request->new_password == $request->old_password) {
            return redirect()->back()->with('error', __('Old and new password must not be the same'));
        }
        $user->update([
            'password' => bcrypt($request->new_password)
        ]);
        return redirect()->back()->with('success', __('Password Updated Successfully'));
    }
}