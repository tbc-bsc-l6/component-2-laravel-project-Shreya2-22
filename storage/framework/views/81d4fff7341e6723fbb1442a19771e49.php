<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
        <p>Welcome, <?php echo e(auth()->user()->name); ?>!</p>
        <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-4">
            <?php echo csrf_field(); ?>
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
        </form>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/dashboard.blade.php ENDPATH**/ ?>