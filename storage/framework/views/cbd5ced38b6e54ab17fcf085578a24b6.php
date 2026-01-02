<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-slate-900 via-indigo-900 to-purple-900 p-6">
    <div class="text-center space-y-8">
        <!-- Animated Logo -->
        <div class="flex justify-center mb-8">
            <div class="w-32 h-32 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-3xl flex items-center justify-center shadow-2xl animate-pulse">
                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>

        <!-- Title -->
        <div>
            <h1 class="text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 via-purple-300 to-pink-300 tracking-tight">
                EduTrack
            </h1>
            <p class="mt-4 text-xl text-indigo-200 max-w-md mx-auto">
                Your complete educational administration system
            </p>
        </div>

        <!-- Features -->
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <div class="flex items-center space-x-2 bg-white/10 backdrop-blur px-4 py-2 rounded-full">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-white text-sm">Manage Modules</span>
            </div>
            <div class="flex items-center space-x-2 bg-white/10 backdrop-blur px-4 py-2 rounded-full">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-white text-sm">Track Progress</span>
            </div>
            <div class="flex items-center space-x-2 bg-white/10 backdrop-blur px-4 py-2 rounded-full">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-white text-sm">Easy Enrollment</span>
            </div>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">
            <a href="<?php echo e(route('login')); ?>" 
                class="px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span>Sign In</span>
            </a>
            <a href="<?php echo e(route('register')); ?>" 
                class="px-8 py-4 bg-white/10 backdrop-blur border border-white/30 text-white font-semibold rounded-xl shadow-lg hover:bg-white/20 transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                <span>Create Account</span>
            </a>
        </div>
    </div>

    <!-- Footer -->
    <p class="absolute bottom-6 text-indigo-300 text-sm">
        © 2025 EduTrack. Built for education.
    </p>
</div>


<?php /**PATH C:\xampp\htdocs\component-2-laravel-project-Shreya2-22\resources\views/livewire/splash-page.blade.php ENDPATH**/ ?>