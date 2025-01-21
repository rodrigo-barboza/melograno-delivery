<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import DishModal from '@/Pages/Establishment/Partials/DishModal.vue';
import EstablishmentCover from '@/Pages/Establishment/Partials/EstablishmentCover.vue';
import EstablishmentInfo from '@/Pages/Establishment/Partials/EstablishmentInfo.vue';
import EstablishmentMenu from '@/Pages/Establishment/Partials/EstablishmentMenu.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    establishment: {
        type: Object,
        required: true,
    },
});

const selectedDish = ref(null);
const showDishModal = ref(false);

const onDishClick = (dish) => (selectedDish.value = dish, showDishModal.value = true);

</script>

<template>
    <Head :title="`${establishment.data.category.name} ${establishment.data.name}`" />
    <MainLayout>
        <template #container>
            <EstablishmentCover :image="establishment.data.image" />
            <EstablishmentInfo :establishment="establishment.data" />
            <EstablishmentMenu
                :dishes="establishment.data.dishes"
                :delivery-average-time="establishment.data.deliveryAverageTime"
                @on-dish-click="onDishClick"
            />
            <DishModal
                v-model="showDishModal"
                :dish="selectedDish"
                @close="showDishModal = false"
            />
        </template>
    </MainLayout>
</template>
