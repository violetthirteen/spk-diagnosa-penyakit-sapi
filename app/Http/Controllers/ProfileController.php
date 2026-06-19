<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $this->compressPhoto($file, $user);
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    private function compressPhoto($file, $user): void
    {
        $sourcePath = $file->getRealPath();
        $destPath = 'profile-photos/' . $user->id . '.webp';
        $fullPath = public_path($destPath);

        [$width, $height] = getimagesize($sourcePath);

        $maxSize = 300;
        $ratio = min($maxSize / $width, $maxSize / $height, 1);
        $newWidth = (int) ($width * $ratio);
        $newHeight = (int) ($height * $ratio);

        $src = match ($file->guessExtension()) {
            'jpeg', 'jpg' => imagecreatefromjpeg($sourcePath),
            'png' => imagecreatefrompng($sourcePath),
            'webp' => imagecreatefromwebp($sourcePath),
            default => null,
        };

        if (! $src) {
            return;
        }

        $dst = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagewebp($dst, $fullPath, 75);
        imagedestroy($src);
        imagedestroy($dst);

        if (file_exists($fullPath)) {
            if ($user->photo && $user->photo !== $destPath && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
            $user->photo = $destPath;
        }
    }
}
