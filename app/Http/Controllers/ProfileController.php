<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validasi data termasuk file
        $validated = $request->validated();

        // Update data user (misalnya nama, email, dll.)
        $request->user()->fill($validated);

        // Jika email diubah, reset status verifikasi email
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Cek apakah ada file foto yang diupload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('uploads/photos', $filename, 'public'); // simpan di folder 'storage/app/public/uploads/photos'

            // Hapus foto lama jika ada
            if ($request->user()->photo) {
                Storage::disk('public')->delete($request->user()->photo);
            }

            
            $request->user()->photo = $path;
        }


        $request->user()->save();


        notify()->success('Berhasil Update Data');
        return redirect()->route('profile.edit');
    }
}
