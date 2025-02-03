<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import DishModal from '@/Pages/Establishment/Partials/DishModal.vue';
import EstablishmentCover from '@/Pages/Establishment/Partials/EstablishmentCover.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import MenuList from '@/Pages/Establishment/Partials/MenuList.vue';

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

const showDishModal = ref(false);
const selectedDish = ref(null);

const onDishClick = (dish) => (selectedDish.value = dish, showDishModal.value = true);
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
                    @on-click="onDishClick"
                />
                <DishModal
                    v-model="showDishModal"
                    :dish="selectedDish"
                    @close="showDishModal = false"
                />
            </section>
        </template>
    </MainLayout>
</template>
