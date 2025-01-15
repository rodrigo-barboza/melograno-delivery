<script setup>

defineProps({
    title: {
        type: String,
        default: '',
    },

    subtitle: {
        type: String,
        default: '',
    },

    imageSrc: {
        type: String,
        default: '',
    },
});

</script>

<template>
    <div class="flex flex-col items-center justify-center">
        <img
            :src="imageSrc"
            class="w-64 h-64"
        />
        <div class="mt-8 text-center text-[#1E1E1E] text-base">
            <div class="font-bold">{{ title }}</div>
            <div class="font-light">{{ subtitle }}</div>
        </div>
    </div>
</template>
