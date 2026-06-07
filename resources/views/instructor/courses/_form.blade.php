{{-- Instructor Course Form (Aligned with Admin Design System) --}}

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

    {{-- TITLE --}}
    <div class="sm:col-span-2">
        <label for="title" class="form-label">
            Course Title <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $course->title ?? '') }}"
            placeholder="e.g. Web Development Basics"
            class="form-input @error('title') border-red-400 @enderror"
            required
        >

        @error('title')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- STATUS --}}
    <div>
        <label for="status" class="form-label">
            Status <span class="text-red-500">*</span>
        </label>

        <select
            id="status"
            name="status"
            class="form-select @error('status') border-red-400 @enderror"
            required
        >
            @foreach(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'] as $value => $label)
                <option value="{{ $value }}"
                    {{ old('status', $course->status ?? 'draft') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>

        @error('status')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- DESCRIPTION --}}
    <div class="sm:col-span-2">
        <label for="description" class="form-label">
            Description
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="Write a short description for your course..."
            class="form-input resize-none"
        >{{ old('description', $course->description ?? '') }}</textarea>

        @error('description')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

</div>