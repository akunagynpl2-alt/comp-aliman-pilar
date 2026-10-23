<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::query()->orderBy('group')->orderBy('id')->get()->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        if (! is_array($request->input('settings'))) {
            throw ValidationException::withMessages([
                'settings' => 'Format pengaturan yang dikirim tidak valid.',
            ]);
        }

        $allowedKeys = SiteSetting::query()->pluck('key')->all();
        $submittedKeys = array_keys($request->input('settings', []));
        $unknownKeys = array_diff($submittedKeys, $allowedKeys);

        if ($unknownKeys !== []) {
            throw ValidationException::withMessages([
                'settings' => 'Terdapat pengaturan yang tidak dikenal.',
            ]);
        }

        $rules = [
            'settings' => ['required', 'array'],
            'settings.*' => ['nullable', 'string', 'max:5000'],
        ];

        foreach ($submittedKeys as $key) {
            $rules["settings.{$key}"] = match ($key) {
                'email', 'email_secondary' => ['nullable', 'email', 'max:255'],
                'phone_main' => ['nullable', 'string', 'max:30', 'regex:/^[0-9+\s().-]+$/'],
                'instagram', 'facebook', 'youtube' => ['nullable', 'url:https', 'max:255'],
                'google_maps_embed' => ['nullable', 'url:https', 'max:2000'],
                'google_analytics_id' => ['nullable', 'regex:/^G-[A-Z0-9]+$/i', 'max:30'],
                default => ['nullable', 'string', 'max:5000'],
            };
        }

        $validated = Validator::make($request->all(), $rules)->validate();

        foreach ($validated['settings'] as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return redirect()->route('admin.pengaturan.index')->with('success', 'Pengaturan situs berhasil disimpan.');
    }
}
