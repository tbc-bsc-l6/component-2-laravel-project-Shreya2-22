<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Teacher Dashboard</h1>

        @if(session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                {{ session('message') }}
            </div>
        @endif

        <!-- Section: Assigned Modules -->
        <div class="bg-white shadow-xl rounded-xl p-8 mb-10 border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                My Assigned Modules
            </h2>

            @if($assignedModules->isEmpty())
                <p class="text-gray-600">No modules assigned yet. Contact an admin to assign modules.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Enrolled Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignedModules as $module)
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $module->module }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $module->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $module->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $module->enrollments()->where('status', 'enrolled')->count() }}/10 students
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Section: Grade Students in Assigned Modules -->
        @if($assignedModules->isNotEmpty())
        <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Grade Students in Module
            </h2>
            <div class="mb-4">
                <label for="selectedModule" class="block text-sm font-medium text-gray-700 mb-2">Select Module</label>
                <select wire:model.live="selectedModule" id="selectedModule" class="border border-gray-300 rounded-lg px-4 py-2">
                    @foreach($assignedModules as $module)
                        <option value="{{ $module->id }}">{{ $module->module }}</option>
                    @endforeach
                </select>
            </div>
            @if($studentsInModule->isEmpty())
                <p class="text-gray-600">No enrolled students in this module.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Student Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Enrolled At</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentsInModule as $enrollment)
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $enrollment->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $enrollment->enrolled_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <button wire:click="gradeStudent({{ $enrollment->id }}, 'PASS')" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">PASS</button>
                                        <button wire:click="gradeStudent({{ $enrollment->id }}, 'FAIL')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">FAIL</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        @endif
    </div>
</div>