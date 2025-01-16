<script setup>

const emit = defineEmits(['on-click']);

defineProps({
    id: {
        type: String,
        default: '',
    },

    name: {
        type: String,
        default: '',
    },

    image: {
        type: String,
        default: '/images/hamburger.webp',
    },
});
</script>

<template>
    <div
        class="flex flex-col items-center gap-4 cursor-pointer"
        @click="emit('on-click', id)"
    >
        <img
            class="mt-1 w-[250px] rounded-xl object-cover hover:filter hover:saturate-150"
            :src="image"
        >
        <div class="text-center text-[#1E1E1E] text-lg font-medium">
            {{ name }}
        </div>
    </div>
</template>
