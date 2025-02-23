<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import DishesSection from '@/Pages/Seller/Menu/Partials/DishesSection.vue';
import MenuHeader from '@/Pages/Seller/Menu/Partials/MenuHeader.vue';
import NewDishModal from './Partials/NewDishModal.vue';
import SellerLayout from '@/Layouts/SellerLayout.vue';

const props = defineProps({
    dishes: {
        type: Array,
        required: true,
    },

    categories: {
        type: Array,
        required: true,
    },
});

const openDishModal = ref(false);

</script>

<template>
    <Head title="Cardápio" />
    <SellerLayout>
        <template #container>
            <MenuHeader @on-new-dish="openDishModal = true" />
            <DishesSection :dishes="dishes" />
            <NewDishModal
                v-model="openDishModal"
                :categories="categories"
            />
        </template>
    </SellerLayout>
</template>
