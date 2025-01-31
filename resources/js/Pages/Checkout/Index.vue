<script setup>
import { computed, onMounted, ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import axios from 'axios';
import CheckoutForm from '@/Pages/Checkout/Partials/CheckoutForm.vue';
import GuestLightLayout from '@/Layouts/GuestLightLayout.vue';
import ResumeCheckout from '@/Pages/Checkout/Partials/ResumeCheckout.vue';
import useToast from '@/Composables/useToast';

const toast = useToast();

const props = defineProps({
    cartItems: {
        type: Array,
        default: () => ([]),
        required: true,
    },
});

const orders = ref([]);
const loading = ref(false);
const deliveryTax = computed(() => orders.value.reduce((total, order) => total + order.delivery_tax, 0));
const paymentType = computed(() => orders.value[0]?.payment_type);

const onOfflinePayment = async () => {
    try {
        await axios.post('/checkout/new-order', { orders: orders.value });
        toast.success('Pedido realizado com sucesso');
        setTimeout(() => router.visit('/'), 500);
    } catch (error) {
        console.error(error);
        toast.error('Ocorreu um erro ao realizar o pedido');
    }
};

const onOnlinePayment = async () => {
    const { data: { url } } = await axios.post('/checkout/stripe-new-order', { orders: orders.value });
    window.location.href = url;
};

</script>

<template>
    <GuestLightLayout container-size="sm:max-w-5xl">
        <Head title="Checkout" />
        <div class="mt-4 flex flex-col gap-4 sm:flex-row justify-between">
            <CheckoutForm
                v-model="orders"
                :cart-items="cartItems.data"
                @loading="loading = $event"
            />
            <ResumeCheckout
                :cart-items="cartItems.data"
                :delivery-tax="deliveryTax"
                :payment-type="paymentType"
                :loading="loading"
                @handle-online-payment="onOnlinePayment"
                @handle-offline-payment="onOfflinePayment"
            />
        </div>
    </GuestLightLayout>
</template>
