<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Admin Dashboard</h1>

        <!--[if BLOCK]><![endif]--><?php if(session('message')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Section 1: Manage Modules -->
        <div class="bg-white shadow-xl rounded-xl p-8 mb-10 border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Manage Modules
            </h2>
            <form wire:submit="addModule" class="mb-6 flex gap-4 items-end">
                <div class="flex-1">
                    <label for="newModule" class="block text-sm font-medium text-gray-700 mb-2">New Module Name</label>
                    <input wire:model="newModule" type="text" id="newModule" placeholder="e.g., Advanced Web Engineering" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition shadow-md">Add Module</button>
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
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Teachers</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($module->module); ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($module->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                        <?php echo e($module->active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <?php echo e($module->teachers->pluck('name')->join(', ') ?: 'None'); ?>

                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <button wire:click="toggleModule(<?php echo e($module->id); ?>)" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Toggle</button>
                                    <select wire:change="attachTeacher(<?php echo e($module->id); ?>, $event.target.value)" class="border border-gray-300 rounded px-2 py-1">
                                        <option value="">Attach Teacher</option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $module->teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button wire:click="detachTeacher(<?php echo e($module->id); ?>, <?php echo e($teacher->id); ?>)" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition text-xs">Detach <?php echo e($teacher->name); ?></button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 2: Manage Users & Roles -->
        <div class="bg-white shadow-xl rounded-xl p-8 mb-10 border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                Manage Users & Roles
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Role</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($user->name); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($user->email); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($user->userRole->role ?? 'N/A'); ?></td>
                                <td class="px-6 py-4">
                                    <select wire:change="changeRole(<?php echo e($user->id); ?>, $event.target.value)" class="border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                        <option value="">Change Role</option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php echo e($user->user_role_id == $role->id ? 'selected' : ''); ?>><?php echo e(ucfirst($role->role)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 3: Manage Enrollments -->
        <div class="bg-white shadow-xl rounded-xl p-8 mb-10 border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Manage Enrollments & Remove Students
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Student</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($enrollment->user->name); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($enrollment->module->module); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($enrollment->status ?? 'Enrolled'); ?></td>
                                <td class="px-6 py-4">
                                    <button wire:click="removeStudentFromModule(<?php echo e($enrollment->id); ?>)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Remove</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 4: Manage Teachers -->
        <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.84L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/></svg>
                Manage Teachers
            </h2>
            <p class="text-gray-600 mb-4">Create teachers by selecting a user below and promoting them. Remove teachers by clicking the button in the table.</p>

            <!-- Form to Create Teacher -->
            <form wire:submit="changeRole($selectedUser, 2)" class="mb-6 flex gap-4 items-end">
                <div class="flex-1">
                    <label for="selectedUser" class="block text-sm font-medium text-gray-700 mb-2">Select User to Promote to Teacher</label>
                    <select wire:model="selectedUser" id="selectedUser" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        <option value="">Choose a user</option>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $users->where('user_role_id', '!=', 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!-- Exclude current teachers -->
                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> (<?php echo e($user->userRole->role); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </select>
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition shadow-md">Create Teacher</button>
            </form>
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectedUser'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

            <!-- Form to Attach Teacher to Module -->
            <form wire:submit="attachTeacherForm" class="mb-6 flex gap-4 items-end">
                <div class="flex-1">
                    <label for="selectedTeacher" class="block text-sm font-medium text-gray-700 mb-2">Select Teacher</label>
                    <select wire:model="selectedTeacher" id="selectedTeacher" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        <option value="">Choose a teacher</option>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </select>
                </div>
                <div class="flex-1">
                    <label for="selectedModule" class="block text-sm font-medium text-gray-700 mb-2">Select Module</label>
                    <select wire:model="selectedModule" id="selectedModule" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        <option value="">Choose a module</option>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($module->id); ?>"><?php echo e($module->module); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </select>
                </div>
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition shadow-md">Attach Teacher</button>
            </form>
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectedTeacher'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectedModule'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

            <!-- Table to List and Remove Teachers -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Teacher Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($teacher->name); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($teacher->email); ?></td>
                                <td class="px-6 py-4">
                                    <button wire:click="changeRole(<?php echo e($teacher->id); ?>, 3)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Remove as Teacher</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/livewire/admin-dashboard.blade.php ENDPATH**/ ?>