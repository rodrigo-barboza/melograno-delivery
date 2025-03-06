<script setup>
import { router, useForm } from '@inertiajs/vue3';
import { onMounted, watch, watchEffect } from 'vue';
import axios from 'axios';
import Modal from '@/Components/Modal.vue';
import NewDishForm from '@/Pages/Seller/Menu/Partials/NewDishForm.vue';
import useToast from '@/Composables/useToast';

const toast = useToast();

const emit = defineEmits(['update:model-value']);

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },

    dish: {
        type: Object,
        required: true,
    },
});

const show = defineModel({
    type: Boolean,
    default: false,
});

const form = useForm({
    name: null,
    description: null,
    price: null,
    image: null,
    category_id: null,
});

watch(show, () => Object.assign(form, props.dish));

const closeModal = () => (emit('update:model-value', false), form.reset());

const handleSuccessDishUpdated = () => (toast.success('Prato atualizado com sucesso'), closeModal(), router.visit('/seller/menu'));

const onSubmit = async (unformattedPrice) => {
    const payload = form.data();
    payload.price = unformattedPrice;
    payload.image = payload.image instanceof File ? payload.image : null;

    try {
        form.processing = true;

        await axios.post(route('seller.menu.update', props.dish.id), payload, {
            ...(payload.image && {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
        });

        handleSuccessDishUpdated();
    } catch ({ response: { data: { message } } }) {
        toast.error(message ?? 'Ocorreu um erro ao atualizar o prato');
    }

    form.processing = false;
};

</script>

<template>
    <Modal
        max-width="4xl"
        :title="`Atualizar prato: ${dish?.name}`"
        :show="show"
        @close="closeModal"
    >
        <NewDishForm
            v-model="form"
            :categories="categories"
            is-edit
            @submit="onSubmit"
        />
    </Modal>
</template>
