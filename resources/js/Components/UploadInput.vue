<script setup>
import { ref } from 'vue';

const emit = defineEmits(['update:model-value']);

const model = defineModel({
    type: String,
    required: true,
});

defineProps({
    accept: {
        type: String,
        default: 'image/png, image/jpeg, image/jpg',
    },
});

const file = ref(null);

const onFileChange = (event) => (file.value = event.target.files[0], emit('update:model-value', file.value));

</script>

<template>
    <div
        class="w-full flex gap-3 text-sm border border-[#CCCCCC] rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 focus:outline-none"
        @click="$refs.uploadInput.click()"
    >
        <div class="rounded-l-lg bg-[#F34444] hover:bg-[#C13636] text-white font-medium w-fit p-3">Selecionar imagem</div>
        <div class="self-center text-ellipsis overflow-hidden whitespace-nowrap max-w-40">
            {{ file?.name ?? 'Nenhuma imagem selecionada' }}
        </div>
    </div>
    <input
        class="hidden"
        ref="uploadInput"
        :accept="accept"
        type="file"
        @change="onFileChange"
    >
</template>
