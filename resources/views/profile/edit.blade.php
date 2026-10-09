@extends('layouts.customer')

@section('title', 'Profile Settings')

@section('customer-content')
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Profile Settings</h1>
        <p class="mt-1 text-slate-500">Update your account details and password.</p>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            {{ __('Saved.') }}
        </div>
    @endif

    <!-- Profile Information -->
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <h2 class="text-lg font-extrabold text-slate-900">Profile Information</h2>
        <p class="mt-1 text-sm text-slate-500">Update your name, email address and phone number.</p>

        <form method="post" action="{{ route('profile.update') }}" class="mt-5 space-y-4">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                       class="w-full rounded-xl border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                       class="w-full rounded-xl border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('email')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="mb-1.5 block text-sm font-semibold text-slate-700">Phone Number</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" placeholder="94712345678" autocomplete="tel"
                       class="w-full rounded-xl border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                <p class="mt-1 text-xs text-slate-400">Sri Lankan format: 947XXXXXXXX (e.g. 94712345678)</p>
                @error('phone')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-1">
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#1D4ED8] px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-[#1D4ED8]/30 transition hover:bg-[#052f88]">
                    <x-ui-icon name="check-circle" class="h-4 w-4" /> Save
                </button>
            </div>
        </form>
    </div>

    <!-- Update Password -->
    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6">
        <h2 class="text-lg font-extrabold text-slate-900">Update Password</h2>
        <p class="mt-1 text-sm text-slate-500">Use a long, random password to keep your account secure.</p>

        <form method="post" action="{{ route('password.update') }}" class="mt-5 space-y-4">
            @csrf
            @method('put')

            <div>
                <label for="update_password_current_password" class="mb-1.5 block text-sm font-semibold text-slate-700">Current Password</label>
                <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                       class="w-full rounded-xl border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                @foreach ($errors->updatePassword->get('current_password') as $message)
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @endforeach
            </div>

            <div>
                <label for="update_password_password" class="mb-1.5 block text-sm font-semibold text-slate-700">New Password</label>
                <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                       class="w-full rounded-xl border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                @foreach ($errors->updatePassword->get('password') as $message)
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @endforeach
            </div>

            <div>
                <label for="update_password_password_confirmation" class="mb-1.5 block text-sm font-semibold text-slate-700">Confirm Password</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                       class="w-full rounded-xl border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @endforeach
            </div>

            <div class="flex items-center gap-3 pt-1">
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#1D4ED8] px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-[#1D4ED8]/30 transition hover:bg-[#052f88]">
                    <x-ui-icon name="lock" class="h-4 w-4" /> Update Password
                </button>

                @if (session('status') === 'password-updated')
                    <span x-data="{ show: true }" x-show="show" x-transition
                          x-init="setTimeout(() => show = false, 2500)"
                          class="text-sm font-medium text-emerald-600">{{ __('Saved.') }}</span>
                @endif
            </div>
        </form>
    </div>
@endsection
