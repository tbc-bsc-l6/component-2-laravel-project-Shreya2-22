<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Student Dashboard</h1>

        <!--[if BLOCK]><![endif]--><?php if(session('message')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <!--[if BLOCK]><![endif]--><?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if($userRole === 'old_student'): ?>
            <!-- Old Students: Only show completed modules -->
            <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-200">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Completed Modules History
                </h2>
                <!--[if BLOCK]><![endif]--><?php if($completedEnrollments->isEmpty()): ?>
                    <p class="text-gray-600">No completed modules yet.</p>
                <?php else: ?>
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
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $completedEnrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($enrollment->module->module); ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($enrollment->enrolled_at ? $enrollment->enrolled_at->format('Y-m-d') : 'N/A'); ?></td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($enrollment->grade === 'PASS' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                                <?php echo e($enrollment->grade ?? 'N/A'); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($enrollment->completed_at ? $enrollment->completed_at->format('Y-m-d') : 'N/A'); ?></td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($enrollment->module->active ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600'); ?>">
                                                <?php echo e($enrollment->module->active ? 'Active' : 'Archived'); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php else: ?>
            <!-- Current Students: Show enrollments, history, and available modules -->
            <!-- Current Enrollments -->
            <div class="bg-white shadow-xl rounded-xl p-8 mb-10 border border-gray-200">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    My Current Enrollments (<?php echo e($enrollments->count()); ?>/4)
                </h2>
                <!--[if BLOCK]><![endif]--><?php if($enrollments->isEmpty()): ?>
                    <p class="text-gray-600">No current enrollments.</p>
                <?php else: ?>
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
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($enrollment->module->module); ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($enrollment->enrolled_at ? $enrollment->enrolled_at->format('Y-m-d') : 'N/A'); ?></td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                In Progress
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <!-- Completed Modules History -->
            <div class="bg-white shadow-xl rounded-xl p-8 mb-10 border border-gray-200">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Completed Modules History
                </h2>
                <!--[if BLOCK]><![endif]--><?php if($completedEnrollments->isEmpty()): ?>
                    <p class="text-gray-600">No completed modules yet.</p>
                <?php else: ?>
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
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $completedEnrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($enrollment->module->module); ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($enrollment->enrolled_at ? $enrollment->enrolled_at->format('Y-m-d') : 'N/A'); ?></td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($enrollment->grade === 'PASS' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                                <?php echo e($enrollment->grade ?? 'N/A'); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($enrollment->completed_at ? $enrollment->completed_at->format('Y-m-d') : 'N/A'); ?></td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($enrollment->module->active ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600'); ?>">
                                                <?php echo e($enrollment->module->active ? 'Active' : 'Archived'); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <!-- Available Modules to Enroll -->
            <!--[if BLOCK]><![endif]--><?php if($enrollments->count() < 4): ?>
                <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-200">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Available Modules to Enroll
                    </h2>
                    <!--[if BLOCK]><![endif]--><?php if($availableModules->isEmpty()): ?>
                        <p class="text-gray-600">No available modules to enroll in.</p>
                    <?php else: ?>
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
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $availableModules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                                            <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($module->module); ?></td>
                                            <td class="px-6 py-4 text-sm text-gray-700">
                                                <?php echo e(10 - $module->enrollments()->where('status', 'enrolled')->count()); ?>/10
                                            </td>
                                            <td class="px-6 py-4">
                                                <button wire:click="enroll(<?php echo e($module->id); ?>)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Enroll</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php else: ?>
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg">
                    You have reached the maximum enrollment limit of 4 modules.
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div><?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/livewire/student-dashboard.blade.php ENDPATH**/ ?>