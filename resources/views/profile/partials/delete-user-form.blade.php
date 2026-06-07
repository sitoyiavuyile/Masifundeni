<section class="card">
    <div class="card-header">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
            {{ __('Once deleted, all data will be permanently removed.') }}
        </p>
    </div>

    <div class="card-body">

        <button
            class="btn-danger"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            Delete Account
        </button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
                @csrf
                @method('delete')

                <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">
                    Are you sure?
                </h2>

                <p class="text-sm text-slate-500 dark:text-slate-400">
                    This action cannot be undone.
                </p>

                <div>
                    <label class="form-label">Password</label>

                    <input
                        type="password"
                        name="password"
                        class="form-input"
                        placeholder="Enter password"
                    >

                    @error('password', 'userDeletion')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" class="btn-secondary" x-on:click="$dispatch('close')">
                        Cancel
                    </button>

                    <button type="submit" class="btn-danger">
                        Delete Account
                    </button>
                </div>
            </form>
        </x-modal>
    </div>
</section>