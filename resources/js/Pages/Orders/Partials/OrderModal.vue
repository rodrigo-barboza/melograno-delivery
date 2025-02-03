<script setup>
import { computed, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { STATUS } from '@/Constants/orderStatus';
import axios from 'axios';
import IndicatorStep from '@/Pages/Orders/Partials/IndicatorStep.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Rating from '@/Pages/Orders/Partials/Rating.vue';
import useCurrency from '@/Composables/useCurrency';
import useToast from '@/Composables/useToast';

const { toCurrency } = useCurrency();
const toast = useToast();

const emit = defineEmits(['update:model-value']);

const show = defineModel({
    type: Boolean,
    default: false,
});

const props = defineProps({
    order: {
        type: Object,
        required: true,
    },
});

const newRate = ref(null);

const orderStatus = computed(() => STATUS[props.order.status]);

const canCancel = computed(() => !['canceled', 'completed'].includes(props.order.status));
const canRate = computed(() => ['completed', 'canceled'].includes(props.order.status) && !props.order.rate);

const updateEstablishmentRate = async () => {
    try {
        await axios.post(`/establishments/${props.order.establishmentId}/${props.order.id}/rate`, { rate: newRate.value });
        toast.success('Estabelecimento avaliado com sucesso');
        router.visit(route('orders.index'));
        emit('update:model-value', false);
    } catch (error) {
        toast.error('Ocorreu um erro ao avaliar o pedido');
        console.error(error);
    }
};

</script>

<template>
    <Modal
        :show="show"
        @close="emit('update:model-value', false)"
    >
        <div class="flex flex-col gap-4 w-full text-[#1E1E1E]">
            <h2 class="text-xl font-semibold">Detalhes do pedido</h2>
            <div class="flex justify-between">
                <div class="flex gap-4">
                    <img
                        class="w-20 h-20 object-cover rounded-xl border border-[#e3e3e3]"
                        :src="order.establishment.cover"
                        :alt="order.establishment.name"
                    >
                    <div>
                        <h4 class="font-bold text-lg">{{ order.establishment.name }}</h4>
                        <div class="flex gap-1 text-sm text-light">
                            <img
                                class="self-center w-4 h-4"
                                :src="`/icons/${orderStatus.icon}.svg`"
                            >
                            <span :class="`text-[${orderStatus.textColor}]`">{{ orderStatus.label }}</span>
                            <span>• Nº {{ order.number }}</span>
                        </div>
                        <ul class="mt-2 text-sm font-light">
                            <li v-for="({ dish, quantity }, index) in order.items" :key="index">
                                {{ quantity }}x {{ dish.name }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-[200px] self-start">
                    <h4 class="font-medium">Resumo do pedido</h4>
                    <p class="mt-2 flex flex-col gap-1 text-sm font-light">
                        <span>Subtotal do pedido: {{ toCurrency(order.totalItems) }}</span>
                        <span>Entrega: {{ order.deliveryTax ? toCurrency(order.deliveryTax) : 'grátis' }}</span>
                        <span>Total: {{ toCurrency(order.total) }}</span>
                    </p>
                </div>
            </div>
            <section>
                <h2 class="text-xl font-semibold">Status atual do pedido</h2>
                <IndicatorStep
                    :status="order.status"
                    :delivery-type="order.deliveryType"
                />
            </section>
            <section>
                <h2 class="text-xl font-semibold">
                    <span v-if="order.deliveryType === 'pickup'">Endereço para retirada</span>
                    <span v-else>Endereço de entrega</span>
                </h2>
                <p class="mt-2 text-[#7E7E7E] text-normal">{{ order.address }}</p>
            </section>
            <template v-if="canCancel">
                <PrimaryButton
                    :disabled="order.status === 'delivering'"
                    @click="emit('on-cancel-order', order)"
                >
                    Cancelar pedido
                </PrimaryButton>
                <small
                    v-if="order.status === 'delivering'"
                    class="mt-[-10px] text-sm text-[#F34444]"
                >
                    O pedido está em rota de entrega e não pode ser cancelado.
                </small>
            </template>
            <template v-if="canRate">
                <h2 class="text-xl font-semibold">Avalie este estabelecimento</h2>
                <div class="flex justify-center">
                    <Rating
                        :rate="5"
                        editable
                        @update:rate="newRate = $event"
                    />
                </div>
                <PrimaryButton
                    @click="updateEstablishmentRate"
                >
                    Avaliar pedido
                </PrimaryButton>
            </template>
        </div>
    </Modal>
</template>
