<template>
    <div>
        <div class="flex flex-col gap-2">
            <a
                class="w-full text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:outline-none font-medium rounded-lg text-sm px-5 py-4 text-center flex justify-center"
                :href="route('social.login', 'google')"
            >
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                    <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                </svg>
                Continuar com o Google
            </a>
            <a
                class="w-full text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:outline-none font-medium rounded-lg text-sm px-5 py-4 text-center flex justify-center"
                :href="route('social.login', 'facebook')"
            >
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                    <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                </svg>
                <div>
                    Continuar com o Facebook
                </div>
            </a>
        </div>
    
        <div class="flex items-center justify-center my-6">
            <hr class="flex-1 h-px bg-gray-300 border-0">
            <span class="mx-2 text-[#1E1E1E] font-semibold">ou</span>
            <hr class="flex-1 h-px bg-gray-300 border-0">
        </div>
    </div>
</template>
