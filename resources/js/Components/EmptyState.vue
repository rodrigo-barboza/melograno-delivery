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

    marginTitle: {
        type: String,
        default: 'mt-8',
    },
});

</script>

<template>
    <div class="flex flex-col items-center justify-center">
        <img
            :src="imageSrc"
            class="w-64 h-64"
        />
        <div :class="`${marginTitle} text-center text-[#1E1E1E] text-base`">
            <div class="font-bold">{{ title }}</div>
            <div class="font-light">{{ subtitle }}</div>
        </div>
    </div>
</template>
