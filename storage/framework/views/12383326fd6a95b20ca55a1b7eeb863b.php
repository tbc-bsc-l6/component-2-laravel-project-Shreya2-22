<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrack - Educational Administration System</title>
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('images/edutrack-logo.svg')); ?>">
    <link rel="shortcut icon" type="image/svg+xml" href="<?php echo e(asset('images/edutrack-logo.svg')); ?>">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo app('flux')->fluxAppearance(); ?>


    <link rel="preconnect" href="https://fonts.bunny.net">    
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
</head>
<body class="min-h-screen bg-gray-100 font-sans antialiased">
    
    <?php if(!Route::is('login') && !Route::is('register') && !Route::is('splash')): ?>    
        <header class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">EduTrack</span>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-4">
                        <?php if(auth()->guard()->check()): ?>
                            <span class="text-white/80 text-sm hidden sm:block">Welcome, <?php echo e(Auth::user()->name); ?></span>
                            <span class="px-3 py-1 bg-white/20 text-white text-xs font-medium rounded-full">
                                <?php echo e(ucfirst(Auth::user()->userRole->role ?? 'User')); ?>

                            </span>
                            <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition duration-200 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="px-4 py-2 text-white hover:text-white/80 text-sm font-medium transition duration-200">Sign In</a>
                            <a href="<?php echo e(route('register')); ?>" class="px-4 py-2 bg-white text-indigo-600 text-sm font-semibold rounded-lg hover:bg-indigo-50 transition duration-200">Register</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
    <?php endif; ?>
    
    <main>
        <?php echo e($slot); ?>

    </main>
    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>