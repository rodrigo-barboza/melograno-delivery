<script setup>
import Navbar from '@/Components/Navbar.vue';
</script>

<template>
    <Navbar />
    <main class="py-8">
        <div class="mt-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <slot />
        </div>
    </main>
</template>
