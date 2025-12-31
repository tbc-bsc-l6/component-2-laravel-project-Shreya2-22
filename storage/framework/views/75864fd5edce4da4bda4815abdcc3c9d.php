<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Teacher Dashboard</h1>

        <!--[if BLOCK]><![endif]--><?php if(session('message')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Section: Assigned Modules -->
        <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                My Assigned Modules
            </h2>

            <!--[if BLOCK]><![endif]--><?php if($assignedModules->isEmpty()): ?>
                <p class="text-gray-600">No modules assigned yet. Contact an admin to assign modules.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $assignedModules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($module->module); ?></td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($module->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                            <?php echo e($module->active ? 'Active' : 'Inactive'); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <!-- Placeholder for future actions like viewing students -->
                                        <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">View Students</button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </tbody>
                    </table>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <!-- Section: Grade Students in Assigned Modules -->
        <!--[if BLOCK]><![endif]--><?php if($assignedModules->isNotEmpty()): ?>
        <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Grade Students in Module
            </h2>
            <div class="mb-4">
                <label for="selectedModule" class="block text-sm font-medium text-gray-700 mb-2">Select Module</label>
                <select wire:model.live="selectedModule" id="selectedModule" class="border border-gray-300 rounded-lg px-4 py-2">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $assignedModules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($module->id); ?>"><?php echo e($module->module); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </select>
            </div>
            <!--[if BLOCK]><![endif]--><?php if($studentsInModule->isEmpty()): ?>
                <p class="text-gray-600">No enrolled students in this module.</p>
            <?php else: ?>
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
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $studentsInModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($enrollment->user->name); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($enrollment->enrolled_at->format('Y-m-d')); ?></td>
                                    <td class="px-6 py-4 space-x-2">
                                        <button wire:click="gradeStudent(<?php echo e($enrollment->id); ?>, 'PASS')" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">PASS</button>
                                        <button wire:click="gradeStudent(<?php echo e($enrollment->id); ?>, 'FAIL')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">FAIL</button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </tbody>
                    </table>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div><?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/livewire/teacher-dashboard.blade.php ENDPATH**/ ?>