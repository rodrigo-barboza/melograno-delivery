<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        v-model="model"
        class="rounded-md py-3 border-[1px] border-[#CCCCCC] focus:border-[1px] placeholder:text-[#AAAAAA] focus:border-[#E8A3A3] focus:ring-[#E8A3A3]"
        ref="input"
        :disabled="disabled"
    />
</template>
