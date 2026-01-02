<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo and Header -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-300">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
            <h1 class="text-4xl font-extrabold text-white tracking-tight">EduTrack</h1>
            <p class="mt-2 text-indigo-200">Educational Administration System</p>
            <h2 class="mt-8 text-2xl font-bold text-white">Welcome back!</h2>
            <p class="mt-2 text-sm text-indigo-300">Sign in to your account to continue</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/20">
            <form wire:submit.prevent="login" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-indigo-100 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input type="email" id="email" wire:model="email" 
                            class="block w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
                            placeholder="you@example.com" autocomplete="email">
                    </div>
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-sm text-red-400 mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-indigo-100 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" id="password" wire:model="password" 
                            class="block w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
                            placeholder="••••••••" autocomplete="current-password">
                    </div>
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-sm text-red-400 mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-[1.02] transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Sign In
                </button>
            </form>

            <!--[if BLOCK]><![endif]--><?php if(session()->has('error')): ?>
                <div class="mt-4 p-3 bg-red-500/20 border border-red-400/30 rounded-xl text-red-200 text-sm text-center">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <div class="mt-6 text-center">
                <p class="text-indigo-200 text-sm">
                    Don't have an account? 
                    <a href="<?php echo e(route('register')); ?>" class="font-semibold text-white hover:text-indigo-300 transition duration-200 underline underline-offset-2">
                        Create one now
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-indigo-300 text-xs">
            © 2025 EduTrack. All rights reserved.
        </p>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/livewire/login-user.blade.php ENDPATH**/ ?>