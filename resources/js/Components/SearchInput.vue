<script setup>
import { onMounted, ref, watch } from 'vue';

const emit = defineEmits(['update:model-value']);

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },

    placeholder: {
        type: String,
        default: 'Buscar no menu',
    },

    rule: {
        type: Function,
        default: () => true,
    },

    maxLength: {
        type: Number,
        default: null,
    },

    sanitizeFunction: {
        type: Function,
        default: (value) => value,
    },

    autofocus: {
        type: Boolean,
        default: false,
    },

    noBorder: {
        type: Boolean,
        default: true,
    },

    customClass: {
        type: String,
        default: '',
    },
});

const inputRef = ref(null);
const internalModel = ref(props.model);

onMounted(() => {
    if (props.autofocus && inputRef.value) {
        setTimeout(() => inputRef.value.focus(), 100);
    }
});

watch(internalModel, (newValue) => {
    if (props.maxLength && props.sanitizeFunction(newValue).length > props.maxLength) {
        internalModel.value = newValue.slice(0, props.maxLength);
    }

    if (!props.rule()) {
        internalModel.value = props.modelValue;
        return;
    }

    emit('update:model-value', internalModel.value);
});

</script>

<template>
    <div class="relative w-full">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg
                class="w-4 h-4 text-gray-500"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
            >
                <path
                    stroke="#F34444"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                />
            </svg>
            <span class="sr-only">Search icon</span>
        </div>
        <input
            v-model="internalModel"
            ref="inputRef"
            class="block w-full p-2 ps-10 text-sm text-gray-900 bg-[#F8F8F8] h-12 rounded-lg focus:ring-[#F34444] focus:border-[#F34444] placeholder:text-[#C5C5C5]"
            :class="`${noBorder ? 'border-none' : '' } ${customClass}`"
            type="text"
            :placeholder="placeholder"
        >
    </div>
</template>
