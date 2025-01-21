<script setup>
import useWeek from '@/Composables/useWeek';
import useCurrency from '@/Composables/useCurrency';
import MoreInfoModal from '@/Pages/Establishment/Partials/MoreInfoModal.vue';
import { ref } from 'vue';

const { isEstablishmentCurrentlyOpen } = useWeek();
const { toCurrency } = useCurrency();

defineProps({
    establishment: {
        type: Object,
        required: true,
    },
});

const showMoreInfoModal = ref(false);

</script>

<template>
    <div class="mt-6 flex justify-between">
        <div class="flex gap-8">
            <div class="flex justify-center items-center">
                <img
                    class="w-32 h-32 object-cover rounded-full border border-[#e3e3e3]"
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
            <div
                class="pe-2 font-semibold cursor-pointer border-r border-gray-200"
                @click="showMoreInfoModal = true"
            >
                Mais informações
            </div>
            <div class="text-[#A6A6A5] font-[400]">
                Pedido mínimo: {{ toCurrency(establishment.minimumOrderValue) }}
            </div>
        </div>
    </div>
    <MoreInfoModal
        title="Informações do estabelecimento"
        :show="showMoreInfoModal"
        :establishment="establishment"
        @close="showMoreInfoModal = false"
    />
</template>
