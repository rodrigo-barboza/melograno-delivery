<script setup>
import GuestLightLayout from '@/Layouts/GuestLightLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import FormTitle from '@/Components/Guest/FormTitle.vue';
import RegisterForm from '@/Pages/Auth/RegisterForm.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLightLayout>
        <Head title="Cadastre-se" />

        <FormTitle title="Cadastrar-se" />

        <RegisterForm
            v-model="form"
            @submit="submit"
        />
    </GuestLightLayout>
</template>
