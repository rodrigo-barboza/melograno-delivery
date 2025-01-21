<script setup>
import EstablishmentCardSkeleton from '@/Pages/Components/EstablishmentCardSkeleton.vue';

defineProps({
    id: {
        type: String,
        default: '',
    },

    name: {
        type: String,
        default: '',
    },

    cover: {
        type: String,
        default: '',
    },

    category: {
        type: Object,
        default: () => ({}),
    },

    rate: {
        type: Number,
        default: 0,
    },

    deliveryAverageTime: {
        type: String,
        default: '',
    },

    loading: {
        type: Boolean,
        default: false
    },
});

</script>

<template>
    <EstablishmentCardSkeleton v-if="loading" />
    <a
        v-else
        :href="route('establishments.show', id)"
        class="flex gap-4 text-[#1E1E1E] rounded-xl border border-[#F2F2F2] p-4 cursor-pointer hover:bg-[#F2F2F2]"
    >
        <img
            class="w-32 h-32 object-cover rounded-xl"
            :src="cover"
        >
        <div class="flex flex-col gap-1">
            <div
                class="text-xl font-semibold text-ellipsis overflow-hidden whitespace-nowrap max-w-52"
            >
                {{ name }}
            </div>
            <div class="text-base text-[#8E8E8E]">
                {{ category?.name }} • {{ deliveryAverageTime }}</div>
            <div class="text-sm text-[#FEAC3E] font-bold flex gap-1">
                <img src="/icons/star.svg" width="14px">
                <span>
                    {{ rate }}
                </span>
            </div>
        </div>
    </a>
</template>
