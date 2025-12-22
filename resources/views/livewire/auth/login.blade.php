<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Login</h2>
    <form wire:submit="login" class="space-y-4">
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
            <input type="checkbox" wire:model="remember" id="remember"> Remember me
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
    </form>
    <p class="mt-4">Don't have an account? <a href="/register" class="text-blue-500">Register</a></p>
</div>