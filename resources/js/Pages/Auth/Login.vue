<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import FormTitle from '@/Components/Guest/FormTitle.vue';
import GuestLightLayout from '@/Layouts/GuestLightLayout.vue';
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
    <GuestLightLayout>
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
    </GuestLightLayout>
</template>
