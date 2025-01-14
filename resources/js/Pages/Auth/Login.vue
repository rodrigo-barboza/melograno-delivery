<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import FormTitle from '@/Components/Guest/FormTitle.vue';
import LoginForm from '@/Pages/Auth/LoginForm.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <FormTitle title="Acesse sua conta" />

        <LoginForm
            v-model="form"
            :can-reset-password="canResetPassword"
            @submit="submit"
        />
    </GuestLayout>
</template>
