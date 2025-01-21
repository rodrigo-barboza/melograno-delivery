<script setup>

defineProps({
    image: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <img
        class="w-full h-48 object-cover filter rounded-xl border border-[#e3e3e3] grayscale opacity-70"
        :src="image"
    >
</template>
