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

    imageClass: {
        type: String,
        default: 'w-64 h-64',
    },
});

</script>

<template>
    <div class="flex flex-col items-center justify-center">
        <img
            :src="imageSrc"
            :class="imageClass"
        />
        <div :class="`${marginTitle} text-center text-[#1E1E1E] text-base`">
            <div class="font-bold">{{ title }}</div>
            <div class="font-light">{{ subtitle }}</div>
        </div>
    </div>
</template>
