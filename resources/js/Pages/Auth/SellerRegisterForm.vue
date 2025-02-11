<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { ref } from 'vue';

const emit = defineEmits(['submit']);

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const form = defineModel({
    type: Object,
    required: true,
});

const confirmedTerms = ref(false);

const businessRegistrationOptions = [
    { label: 'CPF', value: 'cpf' },
    { label: 'CNPJ', value: 'cnpj' },
];

const resolveMask = computed(() => {
    return form.value.business_registration_type === 'cpf'
        ? '###.###.###-##'
        : '##.###.###/####-##';
});

</script>

<template>
    <form
        class="mt-4 flex flex-col gap-3"
        @submit.prevent
    >
        <div class="grid grid-cols-3 gap-2 w=full">
            <div class="col-span-2">
                <TextInput
                    v-model="form.business_registration"
                    v-mask="resolveMask"
                    class="block w-full"
                    placeholder="Inscrição empresarial"
                    type="text"
                    autofocus
                />
                <InputError :message="form.errors.business_registration" />
            </div>
            <div class="col-span-1 w-full">
                <SelectInput
                    v-model="form.business_registration_type"
                    class="block w-full"
                    :options="businessRegistrationOptions"
                />
                <InputError :message="form.errors.business_registration_type" />
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <TextInput
                v-model="form.name"
                type="text"
                class="block w-full"
                placeholder="Nome da empresa"
            />
            <InputError :message="form.errors.name" />
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="flex flex-col gap-2">
                <TextInput
                    v-model="form.phone"
                    v-mask="['(##) ####-####', '(##) #####-####']"
                    type="text"
                    class="block w-full"
                    placeholder="Telefone"
                />
                <InputError :message="form.errors.phone" />
            </div>
            <div class="flex flex-col gap-2">
                <TextInput
                    v-model="form.cep"
                    v-mask="'#####-###'"
                    type="text"
                    class="block w-full"
                    placeholder="CEP"
                />
                <InputError :message="form.errors.cep" />
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
                <TextInput
                    v-model="form.address"
                    type="text"
                    class="block w-full"
                    placeholder="Endereço"
                />
                <InputError :message="form.errors.address" />
            </div>
            <div class="col-span-1">
                <TextInput
                    v-model="form.number"
                    type="text"
                    class="block w-full"
                    placeholder="Número"
                />
                <InputError :message="form.errors.number" />
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <SelectInput
                v-model="form.category"
                class="block w-full"
                placeholder="Selecione a categoria"
                :options="categories"
            />
            <InputError :message="form.errors.category" />
        </div>
        <div class="col-span-1">
            <TextInput
                v-model="form.responsible_name"
                type="text"
                class="block w-full"
                placeholder="Nome do responsável"
            />
            <InputError :message="form.errors.responsible_name" />
        </div>
        <div class="col-span-1">
            <TextInput
                v-model="form.email"
                type="email"
                class="block w-full"
                placeholder="E-mail de acesso"
            />
            <InputError :message="form.errors.email" />
        </div>
        <div class="flex flex-col gap-2">
            <TextInput
                v-model="form.password"
                class="block w-full"
                type="password"
                placeholder="Senha de acesso"
            />
            <InputError :message="form.errors.password" />
        </div>
        <div class="flex flex-col gap-2">
            <TextInput
                v-model="form.password_confirmation"
                class="block w-full"
                type="password"
                placeholder="Confirmar senha de acesso"
            />
            <InputError :message="form.errors.password" />
        </div>
        <div class="flex items-center">
            <input
                v-model="confirmedTerms"
                class="w-4 h-4 bg-[#E8A3A3] border-[#E8A3A3] rounded-sm focus:ring-[#F34444] focus:ring-2 hover:bg-[#F34444] checked:bg-[#F34444] checked:hover:bg-[#F34444] checked:focus:bg-[#F34444] focus:bg-[#F34444] active:bg-[#F34444] checked:border-[#F34444]"
                id="confirm-terms"
                type="checkbox"
            >
            <label for="confirm-terms" class="ms-2 text-sm font-medium">
                Concordo com os <span class="underline">termos de uso</span>
            </label>
        </div>
        <PrimaryButton
            :disabled="form.processing || !confirmedTerms"
            @click="emit('submit', form)"
        >
            Cadastrar
        </PrimaryButton>

        <div class="text-center mb-20">
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
