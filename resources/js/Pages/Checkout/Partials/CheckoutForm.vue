<script setup>
import { computed, ref, watch, watchEffect } from 'vue';
import DeliveryAddress from '@/Pages/Checkout/Partials/DeliveryAddress.vue';
import DeliveryManComment from '@/Pages/Checkout/Partials/DeliveryManComment.vue';
import RadioInput from '@/Components/RadioInput.vue';
import useAuth from '@/Composables/useAuth';
import useOrder from '@/Composables/useOrder';

const { address } = useAuth();
const { makeOrders, getEstablishments } = useOrder();

const emit = defineEmits(['update:model-value', 'loading']);

const props = defineProps({
    cartItems: {
        type: Array,
        required: true,
    },
});

const form = ref({
    items: [],
    establishment_id: null,
    payment_type: { label: 'Retirada', value: 'pickup' },
    delivery_type: { label: 'Retirada', value: 'pickup' },
    instructions: '',
    delivery_tax: null,
    address: null,
});

const radioOptions = [
    { label: 'Retirada', value: 'pickup' },
    { label: 'Online', value: 'online' },
];

const deliveryOptions = [
    { label: 'Retirada', value: 'pickup' },
    { label: 'Delivery', value: 'delivery' },
];

const addresses = computed(() => form.value.delivery_type === 'pickup'
    ? getEstablishments(props.cartItems).map((establishment) => `${establishment.address}, ${establishment.number}`)
    : [address()]
);

watchEffect(async () => {
    emit('loading', true);
    emit('update:model-value', await makeOrders(form.value, props.cartItems))
    emit('loading', false);
});

</script>

<template>
    <div class="w-full text-[#1E1E1E] p-4">
        <h2 class="text-xl font-medium">Pagamento</h2>
        <div class="mt-4">
            <RadioInput
                v-model="form.payment_type"
                name="payment-radio"
                :options="radioOptions"
            />
        </div>
        <hr class="my-4 flex-1 h-px bg-gray-300 border-0">
        <h2 class="text-xl font-medium">Entrega</h2>
        <div class="mt-4">
            <RadioInput
                v-model="form.delivery_type"
                name="delivery-radio"
                :options="deliveryOptions"
            />
        </div>
        <DeliveryAddress
            :addresses="addresses"
            :is-pickup="form.delivery_type.value === 'pickup'"
        />
        <DeliveryManComment
            v-if="form.delivery_type.value === 'delivery'"
            v-model="form.instructions"
            class="w-full"
        />
    </div>
</template>
