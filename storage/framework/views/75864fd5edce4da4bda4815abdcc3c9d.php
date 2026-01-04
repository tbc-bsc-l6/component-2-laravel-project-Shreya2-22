<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-4 md:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-4xl font-bold text-slate-800">Teacher Dashboard</h1>
            <p class="text-slate-500 mt-2 text-sm md:text-base">Manage your modules and grade students</p>
        </div>

        <!--[if BLOCK]><![endif]--><?php if(session('message')): ?>
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 px-4 md:px-6 py-3 md:py-4 rounded-r-xl mb-6 shadow-sm flex items-center text-sm md:text-base">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-6 mb-6 md:mb-8">
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-xs md:text-sm font-medium">Assigned Modules</p>
                        <p class="text-2xl md:text-3xl font-bold text-slate-800 mt-1"><?php echo e($assignedModules->count()); ?></p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-indigo-100 rounded-lg md:rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-xs md:text-sm font-medium">Total Students</p>
                        <p class="text-2xl md:text-3xl font-bold text-slate-800 mt-1"><?php echo e($assignedModules->sum(fn($m) => $m->enrollments()->where('status', 'enrolled')->count())); ?></p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-emerald-100 rounded-lg md:rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6 col-span-2 md:col-span-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-xs md:text-sm font-medium">Pending Grades</p>
                        <p class="text-2xl md:text-3xl font-bold text-slate-800 mt-1"><?php echo e($studentsInModule instanceof \Illuminate\Pagination\LengthAwarePaginator ? $studentsInModule->total() : $studentsInModule->count()); ?></p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-amber-100 rounded-lg md:rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assigned Modules -->
        <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6 mb-6">
            <div class="flex items-center mb-4 md:mb-6">
                <div class="w-8 h-8 md:w-10 md:h-10 bg-indigo-100 rounded-lg md:rounded-xl flex items-center justify-center mr-3 md:mr-4">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <h2 class="text-lg md:text-xl font-bold text-slate-800">My Assigned Modules</h2>
                    <p class="text-slate-500 text-xs md:text-sm">Modules you are teaching</p>
                </div>
            </div>

            <!--[if BLOCK]><![endif]--><?php if($assignedModules->isEmpty()): ?>
                <div class="text-center py-8 md:py-12 bg-slate-50 rounded-xl">
                    <svg class="w-10 h-10 md:w-12 md:h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <p class="text-slate-500 text-sm md:text-base">No modules assigned yet. Contact an admin to get started.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $assignedModules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border border-slate-200 rounded-xl p-4 md:p-5 hover:shadow-md transition cursor-pointer <?php echo e($selectedModule == $module->id ? 'ring-2 ring-indigo-500 bg-indigo-50' : 'bg-white'); ?>" wire:click="$set('selectedModule', <?php echo e($module->id); ?>)">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 md:w-10 md:h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                            <span class="text-indigo-600 font-bold text-sm"><?php echo e(substr($module->module, 0, 1)); ?></span>
                                        </div>
                                        <h3 class="font-semibold text-slate-800 text-sm md:text-base"><?php echo e($module->module); ?></h3>
                                    </div>
                                    <div class="flex items-center space-x-3 md:space-x-4 text-xs md:text-sm">
                                        <span class="inline-flex items-center <?php echo e($module->active ? 'text-emerald-600' : 'text-slate-500'); ?>">
                                            <span class="w-2 h-2 rounded-full mr-2 <?php echo e($module->active ? 'bg-emerald-500' : 'bg-slate-400'); ?>"></span>
                                            <?php echo e($module->active ? 'Active' : 'Inactive'); ?>

                                        </span>
                                        <span class="text-slate-500"><?php echo e($module->enrollments()->where('status', 'enrolled')->count()); ?>/10 students</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <!-- Grade Students -->
        <!--[if BLOCK]><![endif]--><?php if($assignedModules->isNotEmpty()): ?>
        <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 md:mb-6">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-purple-100 rounded-lg md:rounded-xl flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg md:text-xl font-bold text-slate-800">Grade Students</h2>
                        <p class="text-slate-500 text-xs md:text-sm">Assign pass or fail grades to enrolled students</p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row gap-2 md:gap-3">
                    <input wire:model.live.debounce.300ms="searchStudents" type="text" placeholder="Search students..." class="w-full md:w-64 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <select wire:model.live="selectedModule" class="w-full md:w-auto border border-slate-300 rounded-lg md:rounded-xl px-3 md:px-4 py-2 md:py-2.5 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $assignedModules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($module->id); ?>"><?php echo e($module->module); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </select>
                </div>
            </div>

            <!--[if BLOCK]><![endif]--><?php if($studentsInModule instanceof \Illuminate\Pagination\LengthAwarePaginator ? $studentsInModule->isEmpty() : $studentsInModule->isEmpty()): ?>
                <div class="text-center py-8 md:py-12 bg-slate-50 rounded-xl">
                    <svg class="w-10 h-10 md:w-12 md:h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <p class="text-slate-500 text-sm md:text-base">No enrolled students in this module.</p>
                </div>
            <?php else: ?>
                <!-- Desktop Table -->
                <div class="hidden md:block overflow-hidden rounded-xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Student</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Enrolled At</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $studentsInModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white font-bold text-sm"><?php echo e(strtoupper(substr($enrollment->user->name, 0, 1))); ?></span>
                                            </div>
                                            <div>
                                                <span class="font-medium text-slate-800"><?php echo e($enrollment->user->name); ?></span>
                                                <p class="text-xs text-slate-500"><?php echo e($enrollment->user->email); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600"><?php echo e($enrollment->enrolled_at->format('M d, Y')); ?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button wire:click="gradeStudent(<?php echo e($enrollment->id); ?>, 'PASS')" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-emerald-100 text-emerald-700 hover:bg-emerald-200 transition">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                Pass
                                            </button>
                                            <button wire:click="gradeStudent(<?php echo e($enrollment->id); ?>, 'FAIL')" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-red-100 text-red-700 hover:bg-red-200 transition">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                Fail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="md:hidden space-y-3">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $studentsInModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border border-slate-200 rounded-xl p-4 bg-white">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold text-sm"><?php echo e(strtoupper(substr($enrollment->user->name, 0, 1))); ?></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-slate-800 truncate"><?php echo e($enrollment->user->name); ?></p>
                                    <p class="text-xs text-slate-500 truncate"><?php echo e($enrollment->user->email); ?></p>
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 mb-3">Enrolled: <?php echo e($enrollment->enrolled_at->format('M d, Y')); ?></p>
                            <div class="flex space-x-2">
                                <button wire:click="gradeStudent(<?php echo e($enrollment->id); ?>, 'PASS')" class="flex-1 inline-flex items-center justify-center px-3 py-2 rounded-lg text-sm font-medium bg-emerald-100 text-emerald-700 hover:bg-emerald-200 transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Pass
                                </button>
                                <button wire:click="gradeStudent(<?php echo e($enrollment->id); ?>, 'FAIL')" class="flex-1 inline-flex items-center justify-center px-3 py-2 rounded-lg text-sm font-medium bg-red-100 text-red-700 hover:bg-red-200 transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Fail
                                </button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!-- Pagination -->
                <!--[if BLOCK]><![endif]--><?php if($studentsInModule instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                <div class="mt-4">
                    <?php echo e($studentsInModule->links()); ?>

                </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/livewire/teacher-dashboard.blade.php ENDPATH**/ ?>