<div class="mb-6">
    <h2 class="text-xl font-semibold mb-2">Remove Students from Module</h2>
    <select wire:model.live="selectedCourseId" class="border p-2 w-full mb-4">
        <option value="">Select Module</option>
        @foreach($courses as $course)
        <option value="{{ $course->id }}">{{ $course->name }}</option>
        @endforeach
    </select>
    <table class="w-full border">
        <thead>
            <tr>
                <th class="border p-2">Student Name</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enrollment)
            <tr>
                <td class="border p-2">{{ $enrollment->user->name }}</td>
                <td class="border p-2">{{ $enrollment->user->email }}</td>
                <td class="border p-2">
                    <button wire:click="removeStudent({{ $enrollment->id }})" class="bg-red-500 text-white px-2 py-1">Remove</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if (session()->has('message')) <p class="text-green-500">{{ session('message') }}</p> @endif
</div>