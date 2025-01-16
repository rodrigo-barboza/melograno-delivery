<script setup>

defineProps({
    name: {
        type: String,
        default: '',
    },

    cover: {
        type: String,
        default: '',
    },

    category: {
        type: String,
        default: '',
    },

    rating: {
        type: Number,
        default: 0,
    },

    deliveryAverageTime: {
        type: String,
        default: '',
    },
});

</script>

<template>
    <div class="flex gap-4 text-[#1E1E1E] rounded-xl border border-[#F2F2F2] p-4 cursor-pointer hover:bg-[#F2F2F2]">
        <img
            class="w-32 h-32 object-cover rounded-xl"
            :src="cover"
        >
        <div class="flex flex-col gap-1">
            <div class="text-2xl font-semibold">
                {{ name }}
            </div>
            <div class="text-base text-[#8E8E8E]">
                {{ category }} • {{ deliveryAverage }}</div>
            <div class="text-sm text-[#FEAC3E] font-bold flex gap-1">
                <img src="/icons/star.svg" width="14px">
                <span>
                    {{ rating }}
                </span>
            </div>
        </div>
    </div>
</template>
