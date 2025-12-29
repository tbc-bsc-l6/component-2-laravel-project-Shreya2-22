<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Admin Dashboard</h1>

        @if(session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('message') }}
            </div>
        @endif

        <!-- Section 1: Manage Modules -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Manage Modules</h2>
            <form wire:submit="addModule" class="mb-4 flex gap-4">
                <input wire:model="newModule" type="text" placeholder="New Module Name" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Add Module</button>
            </form>
            @error('newModule') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Module</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Active</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teachers</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($modules as $module)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $module->module }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs {{ $module->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $module->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $module->teachers->pluck('name')->join(', ') ?: 'None' }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <button wire:click="toggleModule({{ $module->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Toggle</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 2: Manage Users and Roles -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Manage Users & Roles</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Current Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Change Role</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $user->userRole->role }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <select wire:change="changeRole({{ $user->id }}, $event.target.value)" class="border border-gray-300 rounded px-3 py-1">
                                        @foreach(\App\Models\UserRole::all() as $role)
                                            <option value="{{ $role->id }}" {{ $user->user_role_id == $role->id ? 'selected' : '' }}>{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 3: Manage Enrollments (Attach/Detach Teachers, Remove Students) -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Manage Enrollments & Teachers</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Module</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Attach Teacher</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($enrollments as $enrollment)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $enrollment->module->module }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $enrollment->user->name }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <select wire:change="attachTeacher({{ $enrollment->module_id }}, $event.target.value)" class="border border-gray-300 rounded px-3 py-1">
                                        <option value="">Select Teacher</option>
                                        @foreach($users->where('user_role_id', 2) as $teacher) <!-- Assuming role ID 2 is teacher -->
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <button wire:click="removeStudentFromModule({{ $enrollment->id }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Remove Student</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 4: Manage Teachers -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Manage Teachers</h2>
            <p class="text-sm text-gray-600 mb-4">To create a teacher, use the "Change Role" dropdown in the Users table above to set a user's role to "teacher".</p>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users->where('user_role_id', 2) as $teacher) <!-- Assuming role ID 2 is teacher -->
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $teacher->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $teacher->email }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <button wire:click="changeRole({{ $teacher->id }}, 3)" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Remove as Teacher</button> <!-- Change to student, assuming ID 3 -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>