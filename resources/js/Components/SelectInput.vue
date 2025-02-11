<script setup>

const model = defineModel({
    type: String,
    required: true,
});

defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },

    options: {
        type: Array,
        default: () => ([]),
        required: true,
    },

    placeholder: {
        type: String,
        default: 'Selecione',
    },
});

</script>

<template>
    <select
        v-model="model"
        placeholder="Selecione"
        class="rounded-md py-3 border border-[#CCCCCC] focus:border-[1px] placeholder:text-[#AAAAAA] focus:border-[#E8A3A3] focus:ring-[#E8A3A3]"
    >
        <option value="" disabled selected hidden>{{ placeholder }}</option>
        <option
            v-for="({ value, label }, index) in options"
            :key="index"
            :value="value"
            :disabled="disabled"
        >
            {{ label }}
        </option>
    </select>
</template>
