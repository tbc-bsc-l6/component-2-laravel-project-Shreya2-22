<div class="mb-6">
    <h2 class="text-xl font-semibold mb-2">Change User Roles</h2>
    <form wire:submit="changeRole" class="space-y-4">
        <select wire:model="selectedUserId" class="border p-2 w-full" required>
            <option value="">Select User</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role->name }})</option>
            @endforeach
        </select>
        <select wire:model="newRoleId" class="border p-2 w-full" required>
            <option value="">Select New Role</option>
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Change Role</button>
    </form>
    @if (session()->has('message')) <p class="text-green-500">{{ session('message') }}</p> @endif
</div>