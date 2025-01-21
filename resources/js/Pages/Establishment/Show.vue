<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import EstablishmentCover from '@/Pages/Establishment/Partials/EstablishmentCover.vue';
import EstablishmentInfo from '@/Pages/Establishment/Partials/EstablishmentInfo.vue';
import EstablishmentMenu from '@/Pages/Establishment/Partials/EstablishmentMenu.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    establishment: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <Head :title="`${establishment.data.category.name} ${establishment.data.name}`" />
    <MainLayout>
        <template #container>
            <EstablishmentCover :image="establishment.data.image" />
            <EstablishmentInfo :establishment="establishment.data" />
            <EstablishmentMenu
                :delivery-average-time="establishment.data.deliveryAverageTime"
            />
        </template>
    </MainLayout>
</template>
