<div class="mb-6">
    <h2 class="text-xl font-semibold mb-2">Manage Teachers</h2>
    <form wire:submit="addTeacher" class="space-y-4 mb-4">
        <input wire:model="name" type="text" placeholder="Name" class="border p-2 w-full" required>
        <input wire:model="email" type="email" placeholder="Email" class="border p-2 w-full" required>
        <input wire:model="password" type="password" placeholder="Password" class="border p-2 w-full" required>
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        <button type="submit" class="bg-green-500 text-white px-4 py-2">Add Teacher</button>
    </form>
    <table class="w-full border">
        <thead>
            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
            <tr>
                <td class="border p-2">{{ $teacher->name }}</td>
                <td class="border p-2">{{ $teacher->email }}</td>
                <td class="border p-2">
                    <button wire:click="removeTeacher({{ $teacher->id }})" class="bg-red-500 text-white px-2 py-1">Remove</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if (session()->has('message')) <p class="text-green-500">{{ session('message') }}</p> @endif
</div>