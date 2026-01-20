<div class="h-screen flex items-center justify-center bg-[#F8F9FA] relative overflow-hidden font-sans text-gray-800">
    {{-- BLOB BACKGROUND --}}
    <div class="absolute -top-32 -left-32 w-[420px] h-[420px] bg-[#C19D60] rounded-full blur-[120px] opacity-40"></div>
    <div class="absolute top-1/4 -right-32 w-[380px] h-[380px] bg-yellow-200 rounded-full blur-[120px] opacity-50"></div>
    <div class="absolute -bottom-32 left-1/4 w-[380px] h-[380px] bg-pink-100 rounded-full blur-[120px] opacity-40"></div>
    
    {{-- CONTENT --}}
    <div class="relative z-10 w-full max-w-md px-4">
    
        {{-- HEADER --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 font-serif">
                Welcome Back
            </h1>
            <p class="mt-2 text-gray-600">
                Masuk untuk menjelajahi keindahan Kuningan
            </p>
        </div>
        
        {{-- CARD --}}
        <div class="relative group">
           <div class="absolute -inset-1 bg-gradient-to-r from-[#C19D60] to-yellow-200 rounded-3xl blur opacity-20 group-hover:opacity-40 transition"></div>
           
           <div class="relative bg-white/60 backdrop-blur-xl border border-white/50 rounded-3xl p-8 shadow-lg">
               {{-- Session Status --}}
               <x-auth-session-status class="text-center mb-4" :status="session('status')" />

               <form wire:submit="login" class="space-y-5">
                   {{-- Email --}}
                   <div>
                       <label for="email" class="text-sm font-semibold mb-1 block">Email</label>
                       <input 
                            wire:model="email"
                            id="email"
                            type="email" 
                            required 
                            placeholder="name@example.com"
                            class="w-full px-4 py-3 rounded-xl bg-white/70 border-gray-200 border focus:ring-2 focus:ring-[#C19D60]/50 focus:border-[#C19D60] focus:outline-none transition-all placeholder:text-gray-400"
                       >
                       @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                   </div>

                   {{-- Password --}}
                   <div>
                       <label for="password" class="text-sm font-semibold mb-1 block">Password</label>
                       <input 
                            wire:model="password"
                            id="password"
                            type="password" 
                            required 
                            placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-xl bg-white/70 border-gray-200 border focus:ring-2 focus:ring-[#C19D60]/50 focus:border-[#C19D60] focus:outline-none transition-all placeholder:text-gray-400"
                       >
                       @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                   </div>
                   
                   {{-- Remember & Forgot Password --}}
                   <div class="flex justify-between text-sm">
                       <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                           <input wire:model="remember" type="checkbox" class="rounded border-gray-300 text-[#C19D60] shadow-sm focus:ring-[#C19D60] focus:ring-offset-0" />
                           Ingat saya
                       </label>
                       
                       @if (Route::has('password.request'))
                           <a href="{{ route('password.request') }}" wire:navigate class="text-[#C19D60] font-semibold cursor-pointer hover:underline">
                               Lupa password?
                           </a>
                       @endif
                   </div>
                   
                   {{-- Button --}}
                   <button type="submit" class="w-full py-3 rounded-xl bg-[#C19D60] text-white font-bold hover:bg-[#a6854e] transition-colors shadow-md hover:shadow-lg transform active:scale-[0.98]">
                       LOGIN
                   </button>
               </form>
               
               {{-- Divider --}}
               <div class="my-6 text-center text-xs text-gray-500 relative">
                    <span class="bg-transparent px-2 relative z-10">atau masuk dengan</span>
               </div>
               
               {{-- Google Login --}}
               @if (env('GOOGLE_ACTIVE'))
                   <a href="{{ route('social.login', 'google') }}" class="w-full flex justify-center items-center py-3 rounded-xl bg-white border border-gray-200 hover:bg-gray-50 hover:shadow transition font-semibold text-gray-700">
                       <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5 mr-2" alt="Google logo">
                       Google
                   </a>
               @else
                    {{-- Fallback button just for visual parity if env is not set, or you can hide it --}}
                   <button disabled class="w-full py-3 rounded-xl bg-gray-100 border border-gray-200 text-gray-400 font-semibold cursor-not-allowed">
                       Google (Disabled)
                   </button>
               @endif

           </div>
        </div>
        
        {{-- Register Link --}}
        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun? 
                <a href="{{ route('register') }}" wire:navigate class="font-bold text-[#C19D60] hover:underline">
                    Daftar sekarang
                </a>
            </p>
        @endif
        
    </div>
</div>
