<div class="mb-6">
    <h2 class="text-xl font-semibold mb-2">Add New Module</h2>
    <form wire:submit="addModule" class="space-y-4">
        <input wire:model="name" type="text" placeholder="Module Name" class="border p-2 w-full">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add Module</button>
    </form>
    @if (session()->has('message')) <p class="text-green-500">{{ session('message') }}</p> @endif
</div>