<script setup>
import { computed, watchEffect } from 'vue';
import { ref } from 'vue';
import axios from 'axios';
import useToast from '@/Composables/useToast';

const toast = useToast();

const props = defineProps({
    image: {
        type: Object,
        required: true,
    },

    grayscale: {
        type: Boolean,
        default: true,
    },

    updatable: {
        type: Boolean,
        default: false,
    },
});

const showHover = ref(false);
const uploadImageInput = ref(null);
const uploadedImage = ref(null);

const resolveImage = computed(() => {
    return uploadedImage.value instanceof File
        ? URL.createObjectURL(uploadedImage.value)
        : props.image;
});

watchEffect(async () => {
    if (uploadedImage.value instanceof File) {
        const payload = new FormData();
        payload.append('image', uploadedImage.value);

        try {
            await axios.post(route('settings.update-cover'), payload, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });

            toast.success('Imagem atualizada com sucesso');
        } catch (error) {
            toast.error('Ocorreu um erro ao atualizar a imagem');
        }
    }
});

</script>

<template>
    <div class="relative">
        <img
            class="w-full h-48 object-cover rounded-xl border border-[#e3e3e3]"
            :class="{ 'filter grayscale opacity-70': grayscale }"
            :src="resolveImage"
            @mouseover="showHover = true"
        >
        <div
            v-if="updatable && showHover"
            class="absolute top-0 cursor-pointer flex justify-center align-center rounded-xl w-full h-48 bg-[#000] opacity-20"
            @mouseleave="showHover = false"
            @click="uploadImageInput.click()"
        >
            <img src="/icons/cam-plus.svg" class="w-16">
        </div>
        <input
            ref="uploadImageInput"
            class="hidden"
            type="file"
            @change="uploadedImage = $event.target.files[0]" accept="image/jpeg, image/png, image/jpg"
        >
    </div>
</template>
