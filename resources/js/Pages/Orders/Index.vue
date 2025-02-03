<script setup>
import { computed, ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import axios from 'axios';
import EmptyState from '@/Components/EmptyState.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import Order from '@/Pages/Orders/Mappers/Order';
import OrderList from '@/Pages/Orders/Partials/OrderList.vue';
import OrderModal from '@/Pages/Orders/Partials/OrderModal.vue';
import SearchInput from '@/Components/SearchInput.vue';
import useToast from '@/Composables/useToast';

const toast = useToast();

const props = defineProps({
    orders: {
        type: Array,
        default: () => ([]),
    },

    pagination: {
        type: Object,
        default: () => ({}),
    },
});

const search = ref(null);
const currentItem = ref(null);
const showItemModal = ref(false);

const groupedOrders = computed(() => Object.entries(props.orders)
    .map(([date, orders]) => ({ date, orders: orders.map(order => new Order(order)) }))
);
const hasOrders = computed(() => groupedOrders.value.length > 0);

const handleItemClick = (order) => (currentItem.value = order, showItemModal.value = true);
const onCancelOrder = async (order) => {
    try {
        await axios.patch(`/orders/${order.id}/cancel`);
        toast.success('Pedido cancelado com sucesso');
        router.visit(route('orders.index'));
    } catch (error) {
        toast.error('Ocorreu um erro ao cancelar o pedido');
        console.error(error);
    }
};

</script>

<template>
    <Head title="Meus pedidos" />
    <MainLayout>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 lg:px-8">
            <div class="text-[#1E1E1E] font-bold text-2xl mb-6">Meus pedidos</div>
        </div>
        <template #container>
            <SearchInput
                v-model="search"
                placeholder="Buscar pedido"
            />
            <div
                v-if="!hasOrders"
                class="mt-16 flex flex-col items-center gap-4"
            >
                <EmptyState
                    title="Você ainda não realizou nenhum pedido"
                    subtitle="Faça agora mesmo seu pedido"
                    image-src="/images/empty-orders.svg"
                    image-class="w-52 h-52"
                />
                <Link
                    class="text-[#F34444] text-base font-medium hover:underline"
                    :href="route('index')">Página inicial
                </Link>
            </div>
            <OrderList
                v-else
                :orders="groupedOrders"
                @on-item-click="handleItemClick"
            />
            <OrderModal
                v-model="showItemModal"
                :order="currentItem"
                @close="showItemModal = false"
                @on-cancel-order="onCancelOrder"
            />
        </template>
    </MainLayout>
</template>
