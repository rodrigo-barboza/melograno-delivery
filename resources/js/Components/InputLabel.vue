<script setup>
defineProps({
    value: {
        type: String,
    },

    textSize: {
        type: String,
        default: 'lg',
        validator: (value) => ['xs', 'sm', 'md', 'lg', 'xl', '2xl'].includes(value),
    },
});
</script>

<template>
    <label :class="`block text-${textSize} font-[500] text-[#1E1E1E]`">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
