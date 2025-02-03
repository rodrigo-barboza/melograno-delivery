<script setup>
import { CANCELED, STATUS } from '@/Constants/orderStatus';
import { computed, ref } from 'vue';
import axios from 'axios';
import Rating from '@/Pages/Orders/Partials/Rating.vue';
import useToast from '@/Composables/useToast';

const toast = useToast();

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
    establishmentId: {
        type: String,
        required: true,
    },
    paymentType: {
        type: String,
        required: true,
    },
    paymentStatus: {
        type: String,
        required: true,
    },
    deliveryType: {
        type: String,
        required: true,
    },
    status: {
        type: String,
        required: true,
    },
    number: {
        type: String,
        required: true,
    },
    address: {
        type: String,
        required: true,
    },
    cancelationReason: {
        type: String,
        required: true,
    },
    total: {
        type: Number,
        required: true,
    },
    deliveryTax: {
        type: Number,
    },
    totalItems: {
        type: Number,
        required: true,
    },
    rate: {
        type: Number,
    },
    items: {
        type: Array,
        required: true,
    },
    establishment: {
        type: Object,
        required: true,
    },
});

const loadingPayment = ref(false);

const orderStatus = computed(() => STATUS[props.status]);

const handleRedirectToPayment = async () => {
    try {
        loadingPayment.value = true;
        const { data: { url } } = await axios.get(`/checkout/retrieve/${props.id}`);
        window.location.href = url;
    } catch (error) {
        toast.error('Ocorreu um erro ao redirecionar para o pagamento, tente novamente mais tarde');
        console.error(error);
    } finally {
        loadingPayment.value = false;
    }
};

</script>

<template>
    <div class="flex justify-between text-[#1E1E1E] rounded-xl border border-[#F2F2F2] p-6 cursor-pointer hover:bg-[#F2F2F2]">
        <div class="flex gap-16">
            <div class="flex gap-4">
                <img
                    class="w-16 h-16 object-cover rounded-xl border border-[#e3e3e3]"
                    :src="establishment.cover"
                    :alt="establishment.name"
                >
                <div>
                    <h4 class="font-bold text-lg">{{ establishment.name }}</h4>
                    <div class="flex gap-1 text-sm text-light">
                        <img
                            class="self-center w-4 h-4"
                            :src="`/icons/${orderStatus.icon}.svg`"
                        >
                        <span :class="`text-[${orderStatus.textColor}]`">{{ orderStatus.label }}</span>
                        <span>• Nº {{ number }}</span>
                    </div>
                    <ul class="mt-2 text-sm font-light">
                        <li v-for="({ dish, quantity }, index) in items" :key="index">
                            {{ quantity }}x {{ dish.name }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <div>
                    <h4 class="font-normal text-normal">Avaliação</h4>
                    <Rating :rate="rate" />
                </div>
                <div v-if="status === CANCELED">
                    <h4 class="font-normal text-normal">Motivo do cancelamento</h4>
                    <div class="text-sm text-[#7E7E7E]">
                        {{ cancelationReason }}
                    </div>
                </div>
            </div>
        </div>
        <button
            v-if="paymentStatus === 'unpaid'"
            class="self-center text-white bg-[#F34444] hover:bg-[#F34444] border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
            :class="{ 'disabled': loadingPayment }"
            type="button"
            @click.stop="handleRedirectToPayment"
        >
            <div v-if="loadingPayment">
                Redirecionando...
            </div>
            <template v-else>
                Ir para pagamento
            </template>
        </button>
    </div>
</template>

<style scoped>
button.disabled {
    cursor: not-allowed;
    background-color: #EFADAD;
}

button.disabled:hover {
    background-color: #EFADAD;
}

button:not(.disabled):hover {
    background-color: #C13636;
}
</style>
