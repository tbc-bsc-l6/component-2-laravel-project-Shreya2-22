<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Admin Dashboard</h1>

        <!--[if BLOCK]><![endif]--><?php if(session('message')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Section 1: Manage Modules -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Manage Modules</h2>
            <form wire:submit="addModule" class="mb-4 flex gap-4">
                <input wire:model="newModule" type="text" placeholder="New Module Name" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Add Module</button>
            </form>
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['newModule'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

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
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($module->module); ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs <?php echo e($module->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                        <?php echo e($module->active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <?php echo e($module->teachers->pluck('name')->join(', ') ?: 'None'); ?>

                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <button wire:click="toggleModule(<?php echo e($module->id); ?>)" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Toggle</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
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
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($user->name); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($user->email); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($user->userRole->role); ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <select wire:change="changeRole(<?php echo e($user->id); ?>, $event.target.value)" class="border border-gray-300 rounded px-3 py-1">
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = \App\Models\UserRole::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php echo e($user->user_role_id == $role->id ? 'selected' : ''); ?>><?php echo e($role->role); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
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
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($enrollment->module->module); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($enrollment->user->name); ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <select wire:change="attachTeacher(<?php echo e($enrollment->module_id); ?>, $event.target.value)" class="border border-gray-300 rounded px-3 py-1">
                                        <option value="">Select Teacher</option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $users->where('user_role_id', 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!-- Assuming role ID 2 is teacher -->
                                            <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <button wire:click="removeStudentFromModule(<?php echo e($enrollment->id); ?>)" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Remove Student</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
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
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $users->where('user_role_id', 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!-- Assuming role ID 2 is teacher -->
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($teacher->name); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($teacher->email); ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <button wire:click="changeRole(<?php echo e($teacher->id); ?>, 3)" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Remove as Teacher</button> <!-- Change to student, assuming ID 3 -->
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/livewire/admin-dashboard.blade.php ENDPATH**/ ?>