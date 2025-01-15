<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link } from '@inertiajs/vue3';
import SocialButtons from '@/Pages/Auth/SocialButtons.vue';

const form = defineModel({
    type: Object,
    required: true,
});

</script>

<template>
    <form
        class="mt-4 flex flex-col gap-4"
        @submit.prevent="$emit('submit', form)"
    >
        <SocialButtons />

        <div class="mt-[-14px] flex flex-col gap-2">
            <TextInput
                v-model="form.name"
                type="text"
                class="block w-full"
                placeholder="Nome e sobrenome"
                autofocus
            />

            <InputError :message="form.errors.name" />
        </div>

        <div class="flex flex-col gap-2">
            <TextInput
                v-model="form.email"
                type="email"
                class="block w-full"
                placeholder="E-mail"
            />

            <InputError :message="form.errors.email" />
        </div>

        <div class="flex flex-col gap-2">
            <TextInput
                v-model="form.password"
                class="block w-full"
                type="password"
                placeholder="Senha"
            />

            <InputError :message="form.errors.password" />
        </div>

        <div class="flex flex-col gap-2">
            <TextInput
                v-model="form.password_confirmation"
                class="block w-full"
                type="password"
                placeholder="Confirmar senha"
            />

            <InputError :message="form.errors.password" />
        </div>

        <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
        >
            Cadastrar
        </PrimaryButton>

        <div class="text-center mt-2 mb-20">
            <div class="mt-3 text-[#7E7E7E] text-base font-[400]">
                Quer anunciar seus produtos? 
                <Link
                    class="text-base text-[#F34444] hover:underline self-end mb-3"
                    href="/register"
                >
                    Seja um vendedor
                </Link>
            </div>
            <div class="mt-4 text-[#7E7E7E] text-base font-[400]">
                <Link
                    class="text-base text-[#F34444] hover:underline self-end mb-3"
                    href="/login"
                >
                    Já tenho uma conta
                </Link>
            </div>
        </div>
    </form>
</template>
