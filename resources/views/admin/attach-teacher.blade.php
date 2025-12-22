<div class="mb-6">
    <h2 class="text-xl font-semibold mb-2">Attach Teacher to Module</h2>
    <form wire:submit="attachTeacher" class="space-y-4">
        <select wire:model="selectedCourseId" class="border p-2 w-full" required>
            <option value="">Select Module</option>
            @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
        <select wire:model="selectedTeacherId" class="border p-2 w-full" required>
            <option value="">Select Teacher</option>
            @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Attach</button>
    </form>
    @if (session()->has('message')) <p class="text-green-500">{{ session('message') }}</p> @endif
</div>