<script setup>
import { Head } from '@inertiajs/vue3';
import EstablishmentHeader from '@/Pages/Seller/Dashboard/Partials/EstablishmentHeader.vue';
import OrdersFilter from '@/Pages/Seller/Dashboard/Partials/OrdersFilter.vue';
import SellerLayout from '@/Layouts/SellerLayout.vue';

defineProps({
    establishment: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <Head title="Dashboard" />
    <SellerLayout>
        <template #container>
            <EstablishmentHeader :establishment="establishment.data" />
            <section class="mt-6">
                <div class="text-[#1E1E1E] font-bold text-2xl mb-6">Pedidos</div>
                <OrdersFilter />
            </section>
        </template>
    </SellerLayout>
</template>
