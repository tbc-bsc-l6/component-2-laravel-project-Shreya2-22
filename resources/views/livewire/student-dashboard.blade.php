<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Student Dashboard</h1>

        @if(session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                {{ session('message') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @if($userRole === 'old_student')
            <!-- Old Students: Only show completed modules -->
            <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-200">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Completed Modules History
                </h2>
                @if($completedEnrollments->isEmpty())
                    <p class="text-gray-600">No completed modules yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Enrolled At</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Grade</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Completed At</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedEnrollments as $enrollment)
                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $enrollment->module->module }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('Y-m-d') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $enrollment->grade === 'PASS' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $enrollment->grade ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $enrollment->completed_at ? $enrollment->completed_at->format('Y-m-d') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $enrollment->module->active ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600' }}">
                                                {{ $enrollment->module->active ? 'Active' : 'Archived' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @else
            <!-- Current Students: Show enrollments, history, and available modules -->
            <!-- Current Enrollments -->
            <div class="bg-white shadow-xl rounded-xl p-8 mb-10 border border-gray-200">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    My Current Enrollments ({{ $enrollments->count() }}/4)
                </h2>
                @if($enrollments->isEmpty())
                    <p class="text-gray-600">No current enrollments.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Enrolled At</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrollments as $enrollment)
                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $enrollment->module->module }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('Y-m-d') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                In Progress
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Completed Modules History -->
            <div class="bg-white shadow-xl rounded-xl p-8 mb-10 border border-gray-200">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Completed Modules History
                </h2>
                @if($completedEnrollments->isEmpty())
                    <p class="text-gray-600">No completed modules yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Enrolled At</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Grade</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Completed At</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedEnrollments as $enrollment)
                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $enrollment->module->module }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('Y-m-d') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $enrollment->grade === 'PASS' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $enrollment->grade ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $enrollment->completed_at ? $enrollment->completed_at->format('Y-m-d') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $enrollment->module->active ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600' }}">
                                                {{ $enrollment->module->active ? 'Active' : 'Archived' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Available Modules to Enroll -->
            @if($enrollments->count() < 4)
                <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-200">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Available Modules to Enroll
                    </h2>
                    @if($availableModules->isEmpty())
                        <p class="text-gray-600">No available modules to enroll in.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Available Spots</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($availableModules as $module)
                                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $module->module }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-700">
                                                {{ 10 - $module->enrollments()->where('status', 'enrolled')->count() }}/10
                                            </td>
                                            <td class="px-6 py-4">
                                                <button wire:click="enroll({{ $module->id }})" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Enroll</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg">
                    You have reached the maximum enrollment limit of 4 modules.
                </div>
            @endif
        @endif
    </div>
</div>