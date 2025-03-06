<script setup>

defineProps({
    variant: {
        type: String,
        default: 'blue',
        validator: (value) => [
            'blue', 'gray', 'red', 'green', 'yellow', 'indigo', 'purple', 'pink'
        ].includes(value)
    },

    label: {
        type: String,
        required: true
    }
});

</script>

<template>
    <span :class="`bg-${variant}-100 text-${variant}-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded-sm`">
        {{ label }}
    </span>
</template>
