<div class="mb-6">
    <h2 class="text-xl font-semibold mb-2">Toggle Module Availability</h2>
    <table class="w-full border">
        <thead>
            <tr>
                <th class="border p-2">Module Name</th>
                <th class="border p-2">Available</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td class="border p-2">{{ $course->name }}</td>
                <td class="border p-2">{{ $course->available ? 'Yes' : 'No' }}</td>
                <td class="border p-2">
                    <button wire:click="toggleAvailability({{ $course->id }})" class="bg-yellow-500 text-white px-2 py-1">Toggle</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if (session()->has('message')) <p class="text-green-500">{{ session('message') }}</p> @endif
</div>