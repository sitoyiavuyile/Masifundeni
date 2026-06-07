{{-- Student Form (Create/Edit) --}}

@php
    $profile = $student->studentProfile ?? null;
@endphp

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

    {{-- Name --}}
    <div class="sm:col-span-2 md:col-span-1">
        <label for="name" class="form-label">
            Full name <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $student->name ?? '') }}"
            class="form-input @error('name') border-red-400 @enderror"
            required
        >

        @error('name')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="form-label">
            Email <span class="text-red-500">*</span>
        </label>

        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $student->email ?? '') }}"
            class="form-input @error('email') border-red-400 @enderror"
            required
        >

        @error('email')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div>
        <label for="password" class="form-label">
            Password
            @isset($student)
                <span class="text-xs text-slate-400">(leave blank to keep current)</span>
            @else
                <span class="text-red-500">*</span>
            @endisset
        </label>

        <input
            type="password"
            id="password"
            name="password"
            class="form-input @error('password') border-red-400 @enderror"
            @if(!isset($student)) required @endif
        >

        @error('password')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div>
        <label for="password_confirmation" class="form-label">
            Confirm password
        </label>

        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="form-input"
        >
    </div>

    {{-- Phone --}}
    <div>
        <label for="phone" class="form-label">Phone</label>

        <input
            type="tel"
            id="phone"
            name="phone"
            value="{{ old('phone', $profile->phone ?? '') }}"
            class="form-input"
            placeholder="+27 71 000 0000"
        >
    </div>

    {{-- Date of Birth --}}
    <div>
        <label for="date_of_birth" class="form-label">Date of birth</label>

        <input
            type="date"
            id="date_of_birth"
            name="date_of_birth"
            value="{{ old('date_of_birth', optional($profile?->date_of_birth)->format('Y-m-d')) }}"
            class="form-input @error('date_of_birth') border-red-400 @enderror"
        >

        @error('date_of_birth')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status --}}
    <div>
        <label for="status" class="form-label">
            Status <span class="text-red-500">*</span>
        </label>

        <select
            id="status"
            name="status"
            class="form-select"
            required
        >
            @foreach(['active' => 'Active', 'suspended' => 'Suspended', 'graduated' => 'Graduated'] as $val => $label)
                <option value="{{ $val }}"
                    {{ old('status', $profile->status ?? 'active') === $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Address --}}
    <div class="sm:col-span-2">
        <label for="address" class="form-label">Address</label>

        <textarea
            id="address"
            name="address"
            rows="3"
            class="form-input resize-none"
        >{{ old('address', $profile->address ?? '') }}</textarea>
    </div>

</div>