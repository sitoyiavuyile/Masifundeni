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

<div>
    <label class="block text-sm font-medium text-gray-700">Status</label>
    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @foreach(['draft', 'published', 'archived'] as $option)
            <option value="{{ $option }}"
                {{ old('status', $course->status ?? 'draft') === $option ? 'selected' : '' }}>
                {{ ucfirst($option) }}
            </option>
        @endforeach
    </select>
</div>