<script setup>
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const emit = defineEmits(['on-confirm', 'update:model-value']);

const show = defineModel({
    type: Boolean,
    default: false,
});

defineProps({
    title: {
        type: String,
        required: true,
    },

    description: {
        type: String,
        default: '',
    },

    confirmText: {
        type: String,
        default: 'Confirmar',
    },
});

const closeModal = () => emit('update:model-value', false);

</script>

<template>
    <Modal
        max-width="sm"
        :title="title"
        :show="show"
        @close="closeModal"
    >
        <div>
            <p class="text-md text-gray-600">{{ description }}</p>
            <div class="mt-4 flex gap-2">
                <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
                <PrimaryButton @click="emit('on-confirm')">{{ confirmText }}</PrimaryButton>
            </div>
        </div>
    </Modal>
</template>
