<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Register</h2>
    <form wire:submit="register" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium">Name</label>
            <input type="text" wire:model="name" id="name" class="w-full p-2 border rounded" required>
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" wire:model="email" id="email" class="w-full p-2 border rounded" required>
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" wire:model="password" id="password" class="w-full p-2 border rounded" required>
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
            <input type="password" wire:model="password_confirmation" id="password_confirmation" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="w-full bg-green-500 text-white p-2 rounded">Register</button>
    </form>
    <p class="mt-4">Already have an account? <a href="/login" class="text-blue-500">Login</a></p>
</div>