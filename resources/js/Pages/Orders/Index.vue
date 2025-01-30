<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Meus pedidos" />
    <MainLayout>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 lg:px-8">
            <div class="text-[#1E1E1E] font-bold text-2xl mb-6">Meus pedidos</div>
        </div>
        <template #container>
            meus pedidos
        </template>
    </MainLayout>
</template>
