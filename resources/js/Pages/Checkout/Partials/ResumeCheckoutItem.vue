<script setup>
import useCurrency from '@/Composables/useCurrency';

const { toCurrency } = useCurrency();

defineProps({
    dish: {
        type: Object,
        required: true,
    },

    quantity: {
        type: Number,
        required: true,
    },
});

</script>

<template>
    <div class="my-2 flex justify-between">
        <div class="flex gap-4 items-center">
            <img class="w-16 h-16 rounded-md object-cover" :src="dish.image" :alt="dish.name">
            <div class="text-[#1E1E1E] text-lg text-ellipsis overflow-hidden whitespace-nowrap max-w-56">{{ dish.name }}</div>
        </div>
        <div class="self-center text-base text-[#7E7E7E]">
            {{ quantity }} x {{ toCurrency(dish.price) }}
        </div>
    </div>
</template>
