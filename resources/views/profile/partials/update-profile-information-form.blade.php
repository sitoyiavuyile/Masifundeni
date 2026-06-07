<section class="card">
    <div class="card-header">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </div>

    <div class="card-body">

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('patch')

            {{-- Name --}}
            <div>
                <label for="name" class="form-label">Name</label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    class="form-input"
                    value="{{ old('name', $user->name) }}"
                    required
                    autocomplete="name"
                >

                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="form-label">Email</label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-input"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                >

                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 p-4 rounded-lg border border-amber-200 bg-amber-50 dark:bg-amber-900/20 dark:border-amber-800">
                        <p class="text-sm text-amber-800 dark:text-amber-300">
                            {{ __('Your email address is unverified.') }}
                        </p>

                        <button form="send-verification" class="mt-2 text-sm underline text-amber-700 dark:text-amber-300">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4">
                <button type="submit" class="btn-primary">
                    Save
                </button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-slate-500 dark:text-slate-400"
                    >
                        Saved.
                    </p>
                @endif
            </div>

        </form>
    </div>
</section>