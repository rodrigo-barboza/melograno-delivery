<script setup>
import useCurrency from '@/Composables/useCurrency';

const { toCurrency } = useCurrency();

const model = defineModel({
    type: Number,
    required: true,
});

defineProps({
    dishPrice: {
        type: Number,
        required: true,
    },
});

const incrementModelValue = () => (model.value++);

const decrementModelValue = () => {
    if (model.value > 1) {
        model.value--;
    }
};

</script>

<template>
    <div class="mt-4 flex justify-between">
        <div class="text-[#5E6260] font-bold">
            {{  toCurrency(dishPrice) }}
        </div>
        <div class="flex gap-4">
            <div
                class="self-center cursor-pointer flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-[#F34444] rounded-full"
                @click="decrementModelValue"
            >
                -
            </div>
            <div class="text-center self-center font-semibold min-w-6">
                {{ model }}
            </div>
            <div
                class="self-center cursor-pointer flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-[#F34444] rounded-full"
                @click="incrementModelValue"
            >
                +
            </div>
        </div>
    </div>
</template>
