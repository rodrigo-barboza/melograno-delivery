<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
    disabled: {
        type: Boolean,
        default: false
    },
    fluid: {
        type: Boolean,
        default: true
    },
    size: {
        type: String,
        default: 'xs',
        validate: (value) => ['xs', 'sm'].includes(value),
    },
});
</script>

<template>
    <button
        :type="type"
        class="rounded-md border border-gray-300 bg-white px-4 py-2 text-normal font-normal text-gray-700 transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:outline-none"
        :class="{ 'disabled': loading || disabled, 'w-full': fluid, [resolveSize]: true }"
        :disabled="loading || disabled"
    >
        <slot />
    </button>
</template>
