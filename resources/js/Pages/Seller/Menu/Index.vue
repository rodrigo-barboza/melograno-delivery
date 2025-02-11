<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import MenuHeader from '@/Pages/Seller/Menu/Partials/MenuHeader.vue';
import NewDishModal from './Partials/NewDishModal.vue';
import SellerLayout from '@/Layouts/SellerLayout.vue';

defineProps({

});

const openDishModal = ref(false);

</script>

<template>
    <Head title="Cardápio" />
    <SellerLayout>
        <template #container>
            <MenuHeader @on-new-dish="openDishModal = true" />
            <NewDishModal v-model="openDishModal" />
        </template>
    </SellerLayout>
</template>
