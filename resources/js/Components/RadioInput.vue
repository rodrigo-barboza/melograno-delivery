<script setup>

const emit = defineEmits(['update:model-value']);

const model = defineModel({
    type: Object,
    required: true,
});

defineProps({
    options: {
        type: Array,
        default: () => ([]),
    },

    name: {
        type: String,
        default: '',
    },
});

</script>

<template>
    <div class="flex gap-4 mb-4">
        <div
            v-for="(option, index) in options"
            :key="index"
        >
            <input
                v-model="model"
                class="w-4 h-4 text-[#F34444] bg-gray-100 border-gray-300 focus:bg-[#F34444] focus:ring-0 focus:outline-none"
                type="radio"
                :id="`${name}-${index}`"
                :name="name"
                :checked="model.value === option.value"
                @update:model-value="emit('update:model-value', option)"
            >
            <label
                class="ms-2 text-sm font-medium text-gray-900"
                :for="`${name}-${index}`"
            >
                {{ option.label }}
            </label>
        </div>
    </div>
</template>
