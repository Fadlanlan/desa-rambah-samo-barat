<x-guest-layout>
    <div class="mb-10 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-brand-blue-900 mb-6 shadow-xl shadow-brand-blue-500/20">
            <x-application-logo class="w-10 h-10 fill-current text-white" />
        </div>
        <h3 class="text-3xl font-extrabold text-white tracking-tight">System Core Access</h3>
        <p class="text-brand-blue-300 mt-2 font-light">Super Admin Authentication</p>
    </div>

    <form method="POST" action="{{ route('superadmin.login.store') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-brand-blue-200 mb-2">System Identifier</label>
            <input id="email" 
                   class="block w-full px-4 py-3.5 bg-brand-blue-900/50 border border-brand-blue-800 text-white sm:text-sm rounded-xl focus:ring-2 focus:ring-brand-blue-500 focus:border-transparent transition-all placeholder-brand-blue-700 backdrop-blur-sm" 
                   type="email" 
                   name="email" 
                   :value="old('email')" 
                   required 
                   autofocus 
                   autocomplete="username" 
                   placeholder="Enter encrypted email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-brand-blue-200 mb-2">Access Fragment</label>
            <div class="relative">
                <input id="password" 
                       class="block w-full px-4 py-3.5 bg-brand-blue-900/50 border border-brand-blue-800 text-white sm:text-sm rounded-xl focus:ring-2 focus:ring-brand-blue-500 focus:border-transparent transition-all placeholder-brand-blue-700 backdrop-blur-sm"
                       type="password"
                       name="password"
                       required 
                       autocomplete="current-password"
                       placeholder="••••••••" />
                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-4 text-brand-blue-400 hover:text-white transition-colors">
                    <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="eye-slash-icon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const eyeIcon = document.getElementById('eye-icon');
                const eyeSlashIcon = document.getElementById('eye-slash-icon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('hidden');
                    eyeSlashIcon.classList.add('hidden');
                }
            }
        </script>

        <!-- Hidden Captcha for Super Admin (Security is implicit) -->
        <div class="mt-6 opacity-40 hover:opacity-100 transition-opacity">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-semibold text-brand-blue-400 uppercase tracking-widest">Security Protocol</span>
            </div>
            <div class="flex gap-3">
                <div class="flex-shrink-0">
                    <img id="captcha-img" src="{{ captcha_src('flat') }}" alt="captcha" class="rounded-lg border border-brand-blue-800 grayscale invert opacity-70 h-10">
                </div>
                <input id="captcha" 
                       class="block w-full px-4 py-2 bg-brand-blue-900/50 border border-brand-blue-800 text-white text-sm rounded-lg focus:ring-1 focus:ring-brand-blue-500 transition-all placeholder-brand-blue-700"
                       type="text"
                       name="captcha"
                       required
                       placeholder="Verify" />
            </div>
            <x-input-error :messages="$errors->get('captcha')" class="mt-2 text-red-200 text-xs" />
        </div>

        <div class="pt-4">
            <button class="w-full bg-brand-blue-600 hover:bg-brand-blue-500 text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-brand-blue-600/30 transition-all active:scale-[0.98] flex items-center justify-center gap-2 group">
                Establish Connection
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>
        </div>
    </form>

    <style>
        /* Override standard guest layout background for Super Admin */
        body {
            background-color: #020617 !important; /* Extremely dark blue */
        }
        .bg-white.dark\:bg-gray-800 {
            background-color: #0f172a !important; /* Darker card background */
            border: 1px solid #1e293b;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .lg\:flex {
            background-image: linear-gradient(to bottom right, #020617, #1e1b4b) !important;
        }
    </style>
</x-guest-layout>
