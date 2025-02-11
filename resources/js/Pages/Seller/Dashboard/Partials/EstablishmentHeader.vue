<script setup>
import useCurrency from '@/Composables/useCurrency';
import useWeek from '@/Composables/useWeek';

const { toCurrency } = useCurrency();
const { isEstablishmentCurrentlyOpen } = useWeek();

defineProps({
    establishment: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="mt-6 p-4 flex justify-between rounded-2xl border border-[#e3e3e3]">
        <div class="flex gap-8">
            <div class="flex justify-center items-center">
                <img
                    class="w-24 h-24 object-cover rounded-full border border-[#e3e3e3]"
                    :src="establishment.cover"
                    :alt="establishment.name"
                >
            </div>
            <div class="self-center">
                <div class="flex gap-2">
                    <div class="text-2xl text-[#1E1E1E] font-bold">
                        {{ establishment.name }}
                    </div>
                    <div class="self-end mb-[2px] text-sm text-[#FEAC3E] font-bold flex gap-1">
                        <img src="/icons/star.svg" width="14px">
                        <span>
                            {{ establishment.rate }}
                        </span>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="flex items-center gap-2">
                        <template v-if="isEstablishmentCurrentlyOpen(establishment.operatingHour)">
                            <span class="flex w-3 h-3 bg-green-500 rounded-full"></span>
                            <div class="text-[#A6A6A5] text-sm">
                                Aberto
                            </div>
                        </template>
                        <template v-else>
                            <span class="flex w-3 h-3 bg-red-500 rounded-full"></span>
                            <div class="text-[#A6A6A5] text-sm">
                                Fechado
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="self-center text-sm flex gap-2">
            <div class="flex gap-2 rounded-md bg-[#F34444] p-4 text-white">
                <img class="w-8 h-8" src="/icons/order.svg">
                <div>
                    <div class="text-sm font-medium">Pedidos de hoje</div>
                    <div class="text-xs">2 pedidos</div>
                    <div class="text-base font-semibold">R$ 67,90</div>
                </div>
            </div>
            <div class="flex gap-2 rounded-md bg-[#50A773] p-4 text-white">
                <img class="w-8 h-8" src="/icons/payments.svg">
                <div>
                    <div class="text-sm font-medium">Pedidos deste mês</div>
                    <div class="text-xs">2 pedidos</div>
                    <div class="text-base font-semibold">R$ 67,90</div>
                </div>
            </div>
        </div>
    </div>
</template>
