<section class="card">
    <div class="card-header">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">
            {{ __('Update Password') }}
        </h2>

        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
            {{ __('Ensure your account uses a strong password.') }}
        </p>
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            {{-- Current Password --}}
            <div>
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-input">
                @error('current_password', 'updatePassword')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- New Password --}}
            <div>
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-input">
                @error('password', 'updatePassword')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm --}}
            <div>
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input">
                @error('password_confirmation', 'updatePassword')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4">
                <button type="submit" class="btn-primary">
                    Save
                </button>

                @if (session('status') === 'password-updated')
                    <p class="text-sm text-slate-500 dark:text-slate-400">Saved.</p>
                @endif
            </div>

        </form>
    </div>
</section>