<script setup>
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import NewDishForm from '@/Pages/Seller/Menu/Partials/NewDishForm.vue';

const emit = defineEmits(['update:model-value']);

const show = defineModel({
    type: Boolean,
    default: false,
});

const form = useForm({
    name: null,
    description: null,
    price: null,
    image: null,
});

const closeModal = () => (emit('update:model-value', false), form.reset());

const onSubmit = async (unformattedPrice) => {
    form.price = unformattedPrice;
    console.log(form.data());
    // to do
    // closeModal();
};

</script>

<template>
    <Modal
        title="Adicionar novo prato"
        max-width="3xl"
        :show="show"
        @close="closeModal"
    >
        <NewDishForm
            v-model="form"
            @submit="onSubmit"
        />
    </Modal>
</template>
