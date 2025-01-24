<script setup>
import useCurrency from '@/Composables/useCurrency';
import PriceQuantityInput from '@/Components/PriceQuantityInput.vue';
import { ref } from 'vue';

const { toCurrency } = useCurrency();

const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
    dish: {
        type: Object,
        required: true,
    },
    quantity: {
        type: Number,
        default: 1,
    },
});

const internalQuantity = ref(props.quantity);

</script>

<template>
    <div class="flex justify-between border border-[#F2F2F2] rounded-md p-2">
        <div class="flex gap-4">
            <img
                class="w-24 h-24 object-cover rounded-md border border-[#e3e3e3]"
                :src="dish.image"
            >
            <div class="flex flex-col gap-2">
                <div class="text-base font-semibold text-[#1E1E1E] text-ellipsis overflow-hidden whitespace-nowrap max-w-36">
                    {{ dish.name }}
                </div>
                <div class="text-base font-[500] text-[#5E6260]">
                    {{ toCurrency(dish.price) }}
                </div>
                <PriceQuantityInput
                    v-model="internalQuantity"
                    class="mt-2"
                    @change="$emit('on-update-quantity', dish.id, internalQuantity, id)"
                />
            </div>
        </div>
        <div class="align-self-start">
            <button
                class="focus:ring-2 font-medium rounded-full text-sm p-1 text-center inline-flex items-center"
                @click="$emit('on-remove', dish.id, id)"
            >
                <img
                    class="h-5"
                    src="/icons/trash.svg"
                >
            </button>
        </div>
    </div>
</template>
