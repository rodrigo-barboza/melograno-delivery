<script setup>
import Footer from '@/Components/Guest/Footer.vue';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <body class="flex flex-col justify-between max-w-7xl mx-auto min-h-screen px-6 sm:px-0">
        <main>
            <Link
                v-if="route().current('login') || route().current('register')"
                href="/"
            >
                <img src="/images/arrow-left.svg" class="h-10 w-10 mt-12" />
            </Link>
            <div class="flex flex-col items-center pt-6">
                <div>
                    <img src="/images/melograno.svg" class="w-[420px]" />
                </div>
            </div>
            <div
                class="mx-auto mt-12 w-full sm:max-w-md"
            >
                <slot />
            </div>
        </main>
    </body>
    <Footer />
</template>