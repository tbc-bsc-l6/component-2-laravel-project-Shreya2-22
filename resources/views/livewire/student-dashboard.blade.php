<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-4 md:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-4xl font-bold text-slate-800">Student Dashboard</h1>
            <p class="text-slate-500 mt-2 text-sm md:text-base">Track your enrollments and academic progress</p>
        </div>

        @if(session('message'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 px-4 md:px-6 py-3 md:py-4 rounded-r-xl mb-6 shadow-sm flex items-center text-sm md:text-base">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('message') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 md:px-6 py-3 md:py-4 rounded-r-xl mb-6 shadow-sm flex items-center text-sm md:text-base">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @if($userRole === 'old_student')
            <!-- Old Student: Only Completed History -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6">
                <div class="flex items-center mb-4 md:mb-6">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-emerald-100 rounded-lg md:rounded-xl flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg md:text-xl font-bold text-slate-800">Completed Modules History</h2>
                        <p class="text-slate-500 text-xs md:text-sm">Your academic record</p>
                    </div>
                </div>

                @if($completedEnrollments->isEmpty())
                    <div class="text-center py-8 md:py-12 bg-slate-50 rounded-xl">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <p class="text-slate-500 text-sm md:text-base">No completed modules in your history.</p>
                    </div>
                @else
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-hidden rounded-xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Module</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Enrolled</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Grade</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Completed</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @foreach($completedEnrollments as $enrollment)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                                    <span class="text-indigo-600 font-bold text-sm">{{ substr($enrollment->module->module, 0, 1) }}</span>
                                                </div>
                                                <span class="font-medium text-slate-800">{{ $enrollment->module->module }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $enrollment->grade === 'PASS' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $enrollment->grade ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $enrollment->module->active ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $enrollment->module->active ? 'Active' : 'Archived' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="md:hidden space-y-3">
                        @foreach($completedEnrollments as $enrollment)
                            <div class="border border-slate-200 rounded-xl p-4 bg-white">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                            <span class="text-indigo-600 font-bold text-sm">{{ substr($enrollment->module->module, 0, 1) }}</span>
                                        </div>
                                        <span class="font-medium text-slate-800 text-sm">{{ $enrollment->module->module }}</span>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold {{ $enrollment->grade === 'PASS' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $enrollment->grade ?? 'N/A' }}
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600">
                                    <div><span class="font-medium">Enrolled:</span> {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : 'N/A' }}</div>
                                    <div><span class="font-medium">Completed:</span> {{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y') : 'N/A' }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $completedEnrollments->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Current Student Dashboard -->
            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-6 mb-6 md:mb-8">
                <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-500 text-xs md:text-sm font-medium">Current Enrollments</p>
                            <p class="text-2xl md:text-3xl font-bold text-slate-800 mt-1">{{ $enrollments->count() }}/4</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg md:rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            @php $progressWidth = ($enrollments->count() / 4) * 100; @endphp
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progressWidth }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-500 text-xs md:text-sm font-medium">Completed Modules</p>
                            <p class="text-2xl md:text-3xl font-bold text-slate-800 mt-1">{{ $completedEnrollments->total() }}</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-emerald-100 rounded-lg md:rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6 col-span-2 md:col-span-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-500 text-xs md:text-sm font-medium">Pass Rate</p>
                            <p class="text-2xl md:text-3xl font-bold text-slate-800 mt-1">
                                @if($completedEnrollments->total() > 0)
                                    {{ round(($completedEnrollments->where('grade', 'PASS')->count() / max($completedEnrollments->total(), 1)) * 100) }}%
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-100 rounded-lg md:rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Enrollments -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6 mb-6">
                <div class="flex items-center mb-4 md:mb-6">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-blue-100 rounded-lg md:rounded-xl flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg md:text-xl font-bold text-slate-800">My Current Enrollments</h2>
                        <p class="text-slate-500 text-xs md:text-sm">Modules you are currently enrolled in</p>
                    </div>
                </div>

                @if($enrollments->isEmpty())
                    <div class="text-center py-8 md:py-12 bg-slate-50 rounded-xl">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <p class="text-slate-500 text-sm md:text-base">No current enrollments. Browse available modules below!</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
                        @foreach($enrollments as $enrollment)
                            <div class="border border-slate-200 rounded-xl p-4 md:p-5 bg-white hover:shadow-md transition">
                                <div class="flex items-center mb-3">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-bold text-sm">{{ substr($enrollment->module->module, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-slate-800 text-sm">{{ $enrollment->module->module }}</h3>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                        In Progress
                                    </span>
                                    <span class="text-xs text-slate-500">{{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : '' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Available Modules -->
            @if($enrollments->count() < 4)
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6 mb-6">
                <div class="flex items-center mb-4 md:mb-6">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-purple-100 rounded-lg md:rounded-xl flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg md:text-xl font-bold text-slate-800">Available Modules</h2>
                        <p class="text-slate-500 text-xs md:text-sm">Enroll in new modules ({{ 4 - $enrollments->count() }} slots available)</p>
                    </div>
                </div>

                <!-- Search -->
                <div class="mb-4">
                    <input wire:model.live.debounce.300ms="searchAvailable" type="text" placeholder="Search available modules..." class="w-full md:w-64 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                @if($availableModules->isEmpty())
                    <div class="text-center py-8 md:py-12 bg-slate-50 rounded-xl">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-slate-500 text-sm md:text-base">No available modules to enroll in at the moment.</p>
                    </div>
                @else
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-hidden rounded-xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Module</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Available Spots</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @foreach($availableModules as $module)
                                    @php $spots = 10 - $module->enrollments()->where('status', 'enrolled')->count(); @endphp
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                                    <span class="text-purple-600 font-bold text-sm">{{ substr($module->module, 0, 1) }}</span>
                                                </div>
                                                <span class="font-medium text-slate-800">{{ $module->module }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $spots > 5 ? 'bg-emerald-100 text-emerald-700' : ($spots > 0 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                                {{ $spots }}/10 spots
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($spots > 0)
                                                <button wire:click="enroll({{ $module->id }})" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 transition">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                                    Enroll
                                                </button>
                                            @else
                                                <span class="text-slate-400 text-sm">Module Full</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="md:hidden space-y-3">
                        @foreach($availableModules as $module)
                            @php $spots = 10 - $module->enrollments()->where('status', 'enrolled')->count(); @endphp
                            <div class="border border-slate-200 rounded-xl p-4 bg-white">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <span class="text-purple-600 font-bold text-sm">{{ substr($module->module, 0, 1) }}</span>
                                        </div>
                                        <span class="font-medium text-slate-800 text-sm">{{ $module->module }}</span>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $spots > 5 ? 'bg-emerald-100 text-emerald-700' : ($spots > 0 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $spots }}/10
                                    </span>
                                </div>
                                @if($spots > 0)
                                    <button wire:click="enroll({{ $module->id }})" class="w-full inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 transition">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                        Enroll
                                    </button>
                                @else
                                    <p class="text-center text-slate-400 text-sm">Module Full</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $availableModules->links() }}
                    </div>
                @endif
            </div>
            @else
                <div class="bg-amber-50 border-l-4 border-amber-500 text-amber-700 px-4 md:px-6 py-3 md:py-4 rounded-r-xl mb-6 flex items-center text-sm md:text-base">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    You have reached the maximum enrollment limit of 4 modules.
                </div>
            @endif

            <!-- Completed History -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6">
                <div class="flex items-center mb-4 md:mb-6">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-emerald-100 rounded-lg md:rounded-xl flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg md:text-xl font-bold text-slate-800">Completed Modules</h2>
                        <p class="text-slate-500 text-xs md:text-sm">Your academic history</p>
                    </div>
                </div>

                @if($completedEnrollments->isEmpty())
                    <div class="text-center py-8 md:py-12 bg-slate-50 rounded-xl">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <p class="text-slate-500 text-sm md:text-base">No completed modules yet. Keep learning!</p>
                    </div>
                @else
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-hidden rounded-xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Module</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Enrolled</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Grade</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Completed</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @foreach($completedEnrollments as $enrollment)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3">
                                                    <span class="text-emerald-600 font-bold text-sm">{{ substr($enrollment->module->module, 0, 1) }}</span>
                                                </div>
                                                <span class="font-medium text-slate-800">{{ $enrollment->module->module }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $enrollment->grade === 'PASS' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $enrollment->grade ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $enrollment->module->active ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $enrollment->module->active ? 'Active' : 'Archived' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="md:hidden space-y-3">
                        @foreach($completedEnrollments as $enrollment)
                            <div class="border border-slate-200 rounded-xl p-4 bg-white">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3">
                                            <span class="text-emerald-600 font-bold text-sm">{{ substr($enrollment->module->module, 0, 1) }}</span>
                                        </div>
                                        <span class="font-medium text-slate-800 text-sm">{{ $enrollment->module->module }}</span>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold {{ $enrollment->grade === 'PASS' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $enrollment->grade ?? 'N/A' }}
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600">
                                    <div><span class="font-medium">Enrolled:</span> {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : 'N/A' }}</div>
                                    <div><span class="font-medium">Completed:</span> {{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y') : 'N/A' }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $completedEnrollments->links() }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
