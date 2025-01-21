<script setup>
import useCurrency from '@/Composables/useCurrency';

const { toCurrency } = useCurrency();

defineProps({
    name: {
        type: String,
        default: '',
    },

    image: {
        type: String,
        default: '',
    },

    description: {
        type: String,
        default: '',
    },

    price: {
        type: Number,
        default: 0,
    },
});

</script>

<template>
    <div
        class="flex gap-6 text-[#1E1E1E] rounded-xl border border-[#F2F2F2] p-6 cursor-pointer hover:bg-[#F2F2F2]"
        @click="$emit('on-click')"
    >
        <img
            class="w-44 h-40 object-cover rounded-xl"
            :src="image"
        >
        <div class="flex flex-col justify-between gap-2">
            <div class="flex flex-col gap-2">
                <div class="text-xl font-semibold text-[#1E1E1E] text-ellipsis overflow-hidden whitespace-nowrap max-w-80">
                    {{ name }}
                </div>
                <div class="text-lg font-light text-[#1E1E1E]">
                    {{ description }}
                </div>
            </div>
            <div class="text-base">
                {{ toCurrency(price) }} 
            </div>
        </div>
    </div>
</template>
