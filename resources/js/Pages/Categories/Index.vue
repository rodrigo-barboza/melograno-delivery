<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import MenuList from '@/Pages/Establishment/Partials/MenuList.vue';
import EstablishmentCover from '@/Pages/Establishment/Partials/EstablishmentCover.vue';

const props = defineProps({
    dishes: {
        type: Array,
        required: true,
    },

    category: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head :title="`Pratos da categoria: ${category.name}`" />
    <MainLayout>
        <template #container>
            <section class="mt-6">
                <EstablishmentCover
                    :image="category.cover"
                    :grayscale="false"
                />
                <div class="mt-6 text-[#1E1E1E] font-bold text-2xl mb-6">Pratos da categoria: {{ category.name }}</div>
                <MenuList
                    section-title=""
                    :dishes="dishes.data"
                    @on-click="$emit('on-dish-click', $event)"
                />
            </section>
        </template>
    </MainLayout>
</template>
