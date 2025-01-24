<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SocialButtons from '@/Pages/Auth/SocialButtons.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link } from '@inertiajs/vue3';

const form = defineModel({
    type: Object,
    required: true,
});

defineProps({
    canResetPassword: {
        type: Boolean,
    },
});

</script>

<template>
    <form
        class="mt-4"
        @submit.prevent="$emit('submit', form)"
    >
        <SocialButtons />

        <div>
            <TextInput
                v-model="form.email"
                type="email"
                class="mt-1 block w-full"
                placeholder="E-mail"
                autofocus
            />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <TextInput
                v-model="form.password"
                class="block w-full"
                type="password"
                placeholder="Senha"
            />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4 flex flex-col items-center gap-4justify-end">
            <Link
                v-if="canResetPassword"
                :href="route('password.request')"
                class="text-base text-[#F34444] hover:underline self-end mb-3"
            >
                Esqueci minha senha
            </Link>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Entrar
            </PrimaryButton>
        </div>

        <div class="text-center mt-6 mb-12">
            <div class="text-[#7E7E7E] text-base font-[400]">
                Não tem conta?
                <Link
                    class="text-base text-[#F34444] hover:underline self-end mb-3"
                    href="/register"
                >
                    Cadastre-se
                </Link>
            </div>
            <div class="mt-3 text-[#7E7E7E] text-base font-[400]">
                Quer anunciar seus produtos?
                <Link
                    class="text-base text-[#F34444] hover:underline self-end mb-3"
                    href="/register"
                >
                    Seja um vendedor
                </Link>
            </div>
        </div>
    </form>
</template>
