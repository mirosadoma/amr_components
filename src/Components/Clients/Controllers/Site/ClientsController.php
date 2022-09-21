<?php

namespace App\Components\Clients\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Requests
use App\Components\Clients\Requests\Site\UpdateProfileRequest;
use App\Components\Clients\Requests\Site\ChangePasswordRequest;
// Models
use App\Components\Cities\Models\City;
use App\Models\Client;
use Auth;
use Hash;

class ClientsController extends Controller {

    public function profile_index() {
        $client = Auth::user();
        $cities = City::all();
        return view('Clients_Site::edit',get_defined_vars());
    }

    public function profile_update(UpdateProfileRequest $request ,$client) {
        $client = Client::find($client);
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']  = imageUpload($request->image, 'clients');
        }
        $client->update($data);
        return redirect()->back()->with('success', __('Data Updated Successfully'));
    }

    public function change_password_index() {
        $client = Auth::user();
        return view('Clients_Site::change_password',get_defined_vars());
    }

    public function change_password_update(ChangePasswordRequest $request ,Client $client) {
        $client = Auth::user();
        if (!Hash::check($request->old_password ,$client->password)) {
            return redirect()->back()->with('error', __('Old password does not match'));
        }
        if ($request->new_password == $request->old_password) {
            return redirect()->back()->with('error', __('Old and new password must not be the same'));
        }
        $client->update([
            'password' => bcrypt($request->new_password)
        ]);
        return redirect()->back()->with('success', __('Password Updated Successfully'));
    }
}
