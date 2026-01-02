<div class="flex justify-center mt-6">
    <?php if(Route::has('login')): ?>
        <nav class="flex items-center gap-4">
            <?php if(auth()->guard()->check()): ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border 
                        border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] 
                        rounded-sm text-sm leading-normal cursor-pointer">
                        Logout
                    </button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border 
                    border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] 
                    rounded-sm text-sm leading-normal">
                    Login
                </a>
                <a href="<?php echo e(route('register')); ?>"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border 
                    border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] 
                    rounded-sm text-sm leading-normal">
                    Register
                </a>
            <?php endif; ?>
        </nav>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/components/auth-buttons.blade.php ENDPATH**/ ?>