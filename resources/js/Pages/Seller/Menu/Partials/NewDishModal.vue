<script setup>
import { router, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import NewDishForm from '@/Pages/Seller/Menu/Partials/NewDishForm.vue';
import useToast from '@/Composables/useToast';
import axios from 'axios';

const toast = useToast();

const emit = defineEmits(['update:model-value']);

defineProps({
    categories: {
        type: Array,
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

const closeModal = () => (emit('update:model-value', false), form.reset());

const handleSuccessDishStored = () => (toast.success('Prato cadastrado com sucesso'), closeModal(), router.visit('/seller/menu'));

const onSubmit = async (unformattedPrice) => {
    form.price = unformattedPrice;
    form.processing = true;

    try {
        await axios.post(route('seller.menu.store'), form.data(), {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });

        handleSuccessDishStored();
    } catch ({ response: { data: { message } } }) {
        toast.error(message ?? 'Ocorreu um erro ao cadastrar o prato');
    }

    form.processing = false;
};

</script>

<template>
    <Modal
        title="Adicionar novo prato"
        max-width="4xl"
        :show="show"
        @close="closeModal"
    >
        <NewDishForm
            v-model="form"
            :categories="categories"
            @submit="onSubmit"
        />
    </Modal>
</template>
