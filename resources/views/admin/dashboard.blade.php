<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
        <!-- Include Livewire components here -->
        <livewire:admin.add-module />
        <livewire:admin.manage-teachers />
        <livewire:admin.manage-students />
        <livewire:admin.attach-teacher />
        <livewire:admin.change-roles />
        <livewire:admin.toggle-modules />
    </div>
</x-app-layout>