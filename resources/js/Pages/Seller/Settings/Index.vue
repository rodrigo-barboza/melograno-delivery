<script setup>
import { Head } from '@inertiajs/vue3';
import EstablishmentCover from '@/Pages/Establishment/Partials/EstablishmentCover.vue';
import EstablishmentInfo from '@/Pages/Establishment/Partials/EstablishmentInfo.vue';
import SellerLayout from '@/Layouts/SellerLayout.vue';

defineProps({
    establishment: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <Head title="Cardápio" />
    <SellerLayout>
        <template #container>
            <EstablishmentCover
                :image="establishment.image"
                :grayscale="false"
                updatable
            />
            <EstablishmentInfo :establishment="establishment" />
            <div class="mt-12 text-[#1E1E1E] font-bold text-2xl mb-6">Configurações</div>
        </template>
    </SellerLayout>
</template>
