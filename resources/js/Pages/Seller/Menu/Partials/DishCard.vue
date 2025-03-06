<script setup>
import Badge from '@/Components/Badge.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useCurrency from '@/Composables/useCurrency';

const { toCurrency } = useCurrency();

const emit = defineEmits(['on-edit', 'on-delete']);

defineProps({
    name: {
        type: String,
        required: true,
    },

    description: {
        type: String,
        required: true,
    },

    price: {
        type: Number,
        required: true,
    },

    image: {
        type: String,
        required: true,
    },

    category: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <div class="flex justify-between border border-[#F2F2F2] rounded-md p-4">
        <div class="flex gap-4">
            <img
                class="w-24 h-24 object-cover rounded-md border border-[#e3e3e3]"
                :src="image"
                :alt="name"
            >
            <div class="flex flex-col text-[#1E1E1E] max-w-[150px] min-w-[150px]">
                <div class="text-lg font-semibold">{{ name }}</div>
                <div class="text-sm font-light">{{ description }}</div>
                <badge
                    class="mt-2 self-start"
                    :variant="category.variant"
                    :label="category.name"
                />
            </div>
            <div class="ml-12 text-[#1E1E1E]">
                <div class="text-lg font-semibold">Preço</div>
                <div class="text-sm font-light">{{ toCurrency(price) }}</div>
            </div>
        </div>
        <div class="self-center flex gap-2">
            <PrimaryButton
                size="sm"
                @click="emit('on-edit')"
            >
                <img src="/icons/edit.svg" class="w-5 h-5">
            </PrimaryButton>
            <PrimaryButton
                size="sm"
                @click="emit('on-delete')"
            >
                <img src="/icons/trash.svg" class="w-5 h-5">
            </PrimaryButton>
        </div>
    </div>
</template>
