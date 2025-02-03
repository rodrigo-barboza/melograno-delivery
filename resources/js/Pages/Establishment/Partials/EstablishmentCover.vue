<script setup>

defineProps({
    image: {
        type: Object,
        required: true,
    },

    grayscale: {
        type: Boolean,
        default: true,
    },
});

</script>

<template>
    <img
        class="w-full h-48 object-cover rounded-xl border border-[#e3e3e3]"
        :class="{ 'filter grayscale opacity-70': grayscale }"
        :src="image"
    >
</template>
