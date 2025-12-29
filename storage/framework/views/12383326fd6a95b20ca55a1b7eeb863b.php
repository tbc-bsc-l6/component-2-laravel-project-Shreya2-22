<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo app('flux')->fluxAppearance(); ?>


    <link rel="preconnect" href="https://fonts.bunny.net">    
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

</head>
<body class="min-h-screen bg-gray-100">
    
    <?php if(!Route::is('login') && !Route::is('register')): ?>    
        <header class="w-full p-4 bg-white shadow-md flex justify-between items-center">
            <?php if (isset($component)) { $__componentOriginal9d87c63e255afa82c19f5ff3bf8d9ef8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d87c63e255afa82c19f5ff3bf8d9ef8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-buttons','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-buttons'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d87c63e255afa82c19f5ff3bf8d9ef8)): ?>
<?php $attributes = $__attributesOriginal9d87c63e255afa82c19f5ff3bf8d9ef8; ?>
<?php unset($__attributesOriginal9d87c63e255afa82c19f5ff3bf8d9ef8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d87c63e255afa82c19f5ff3bf8d9ef8)): ?>
<?php $component = $__componentOriginal9d87c63e255afa82c19f5ff3bf8d9ef8; ?>
<?php unset($__componentOriginal9d87c63e255afa82c19f5ff3bf8d9ef8); ?>
<?php endif; ?>
        </header>
    <?php endif; ?>
    
    <main class="mt-10">
        <?php echo e($slot); ?>

    </main>
    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>