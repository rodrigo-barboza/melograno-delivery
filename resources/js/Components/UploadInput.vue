<script setup>
import { ref } from 'vue';

const emit = defineEmits(['update:model-value']);

const model = defineModel({
    type: String,
    required: true,
});

const file = ref(null);

const onFileChange = (event) => {
    file.value = event.target.files[0];
    emit('update:model-value', file.value)
};

</script>

<template>
    <input
        class="block w-full text-sm text-white border border-[#E8A3A3] rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
        type="file"
        :value="file"
        :disabled="disabled"
        @change="onFileChange"
    >
</template>
