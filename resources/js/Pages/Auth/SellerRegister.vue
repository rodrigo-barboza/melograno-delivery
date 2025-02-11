<script setup>
import GuestLightLayout from '@/Layouts/GuestLightLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import FormTitle from '@/Components/Guest/FormTitle.vue';
import SellerRegisterForm from '@/Pages/Auth/SellerRegisterForm.vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    business_registration: '',
    business_registration_type: 'cnpj',
    name: '',
    phone: '',
    cep: '',
    address: '',
    number: '',
    category: '',
    responsible_name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('seller-register.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLightLayout>
        <Head title="Seja um vendedor" />

        <FormTitle title="Cadastre sua empresa" />

        <SellerRegisterForm
            v-model="form"
            :categories="categories"
            @submit="submit"
        />
    </GuestLightLayout>
</template>
