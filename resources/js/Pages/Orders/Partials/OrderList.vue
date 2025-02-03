<script setup>
import useDate from '@/Composables/useDate';
import OrderListItem from '@/Pages/Orders/Partials/OrderListItem.vue';

const { toLocaleDateTimeString } = useDate();

const props = defineProps({
    orders: {
        type: Array,
        required: true,
    },
});

</script>

<template>
    <section class="mt-6 text=[#1E1E1E] flex flex-col gap-4">
        <h2 class="text-xl font-medium">Histórico de pedidos</h2>
        <div
            v-for="({ date, orders }, index) in orders"
            class="flex flex-col gap-2"
            :key="index"
        >
            <div class="font-normal">{{ toLocaleDateTimeString(date) }}</div>
            <OrderListItem
                v-for="(order, index) in orders"
                :key="index"
                v-bind="order"
                @click="$emit('on-item-click', order)"
            />
        </div>
    </section>
</template>
