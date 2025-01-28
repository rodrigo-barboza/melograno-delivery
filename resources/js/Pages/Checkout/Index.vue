<script setup>
import { computed, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import CheckoutForm from '@/Pages/Checkout/Partials/CheckoutForm.vue';
import GuestLightLayout from '@/Layouts/GuestLightLayout.vue';
import ResumeCheckout from '@/Pages/Checkout/Partials/ResumeCheckout.vue';

defineProps({
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
            />
        </div>
    </GuestLightLayout>
</template>
