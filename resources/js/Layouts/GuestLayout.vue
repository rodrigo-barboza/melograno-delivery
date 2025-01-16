<script setup>
import Footer from '@/Components/Guest/Footer.vue';
import Navbar from '@/Components/Navbar.vue';
</script>

<template>
    <Navbar />
    <main class="py-8 mb-6">
        <slot />
        <div class="mt-4 mx-auto max-w-7xl px-3 sm:px-6 lg:px-8">
            <hr class="flex-1 h-px bg-gray-300 border-0">
            <slot name="container" />
        </div>
    </main>
    <Footer />
</template>
