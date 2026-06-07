{{-- resources/views/admin/courses/_form.blade.php --}}

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

    {{-- Instructor --}}
    <div class="sm:col-span-2 md:col-span-1">
        <label for="instructor_id" class="form-label">
            Instructor <span class="text-red-500">*</span>
        </label>

        <select
            id="instructor_id"
            name="instructor_id"
            class="form-select @error('instructor_id') border-red-400 @enderror"
            required
        >
            <option value="">Select instructor</option>

            @foreach($instructors as $instructor)
                <option value="{{ $instructor->id }}"
                    {{ old('instructor_id', $course->instructor_id ?? '') == $instructor->id ? 'selected' : '' }}>
                    {{ $instructor->name }}
                </option>
            @endforeach
        </select>

        @error('instructor_id')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Title --}}
    <div>
        <label for="title" class="form-label">
            Course title <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $course->title ?? '') }}"
            placeholder="e.g. Introduction to Programming"
            class="form-input @error('title') border-red-400 @enderror"
            required
        >

        @error('title')
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

    {{-- Description --}}
    <div class="sm:col-span-2">
        <label for="description" class="form-label">
            Description
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="Write a short course description..."
            class="form-input resize-none"
        >{{ old('description', $course->description ?? '') }}</textarea>

        @error('description')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

</div>