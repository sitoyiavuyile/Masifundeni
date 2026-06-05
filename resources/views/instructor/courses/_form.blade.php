<div>
    <label class="block text-sm font-medium text-gray-700">Title</label>
    <input type="text" name="title"
           value="{{ old('title', $course->title ?? '') }}"
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Description</label>
    <textarea name="description" rows="4"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $course->description ?? '') }}</textarea>
</div>

{{-- Inside admin courses _form.blade.php, add instructor selector --}}
<div>
    <label class="block text-sm font-medium text-gray-700">Instructor</label>
    <select name="instructor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @foreach($instructors as $instructor)
            <option value="{{ $instructor->id }}"
                {{ old('instructor_id', $course->instructor_id ?? '') == $instructor->id ? 'selected' : '' }}>
                {{ $instructor->name }}
            </option>
        @endforeach
    </select>
</div>