<script setup>
import { ref, watchEffect } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SearchInput from '@/Components/SearchInput.vue';
import TextInput from '@/Components/TextInput.vue';
import useFormatters from '@/Composables/useFormatters';
import useToast from '@/Composables/useToast';
import viaCepService from '@/Services/viaCep';
import useAuth from '@/Composables/useAuth';

const toast = useToast();

const { sanitizedCep } = useFormatters();
const { updateAddress } = useAuth();

const emit = defineEmits(['update:model-value']);

const show = defineModel({
    type: Boolean,
    default: false,
});

const form = useForm({
    address: null,
    street: null,
    neighborhood: null,
    city: null,
    state: null,
    cep: null,
    number: null,
    complement: null,
});

const searchValue = ref(null);

const closeModal = () => (emit('update:model-value', false), form.reset());

watchEffect(async () => {
    if (sanitizedCep(searchValue.value)?.length === 8) {
        const { data } = await viaCepService(sanitizedCep(searchValue.value));

        if (Object.keys(data).includes('erro')) {
            toast.error('Erro ao buscar o CEP informado, tente novamente ou preencha manualmente.');
            return;
        }

        form.address = `${data.bairro}, ${data.logradouro}, ${data.localidade}, ${data.uf}`;
        form.street = data.logradouro;
        form.neighborhood = data.bairro;
        form.city = data.localidade;
        form.state = data.estado;
        form.cep = sanitizedCep(data.cep);
        form.complement = data.complemento;
    }
});

const searchRule = (value) => {
    if (sanitizedCep(value)?.length === 8) {
        return false;
    }

    return true;
};

const onSubmit = async () => {
    if (!form.cep && sanitizedCep(searchValue.value).length === 8) {
        form.cep = sanitizedCep(searchValue.value);
    }

    if (!form.street || !form.neighborhood) {
        form.street = form.address;
        form.neighborhood = form.address;
    }

    try {
        form.processing = true;
        const { data: { address, message } } = await axios.post(route('addresses.store'), form.data());
        console.log(address, message);
        updateAddress(address);
        form.reset();
        closeModal();
        toast.success(message);
    } catch (error) {
        toast.error('Erro ao cadastrar o endereço, tente novamente mais tarde.');
    }

    form.processing = false;
};

</script>

<template>
    <Modal
        :show="show"
        @close="closeModal"
    >
        <div class="flex flex-col gap-4 w-full">
            <div class="self-center">
                <img
                    class="max-w-[300px]"
                    src="/images/address-placeholder.svg"
                >
                <div class="mt-[-8px] text-xl font-medium text-[#1E1E1E] text-center">
                    Precisamos do seu endereço!
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <div class="text-base font-normal text-[#7E7E7E]">
                    Informe seu CEP para continuar
                </div>
                <SearchInput
                    class="w-full"
                    placeholder="Buscar CEP"
                    :model-value="searchValue"
                    :rule="searchRule"
                    :max-length="8"
                    :sanitize-function="sanitizedCep"
                    autofocus
                    @update:model-value="searchValue = $event"
                />
            </div>
            <form
                class="flex flex-col gap-2"
                @submit.prevent="onSubmit"
            >
                <div>
                    <TextInput
                        v-model="form.address"
                        class="mt-1 block w-full"
                        placeholder="Endereço"
                        type="text"
                        :disabled="form.processing"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.address" />
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <div class="col-span-1">
                        <TextInput
                            v-model="form.number"
                            class="mt-1 block w-full"
                            placeholder="Número"
                            type="text"
                            :disabled="form.processing"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.number" />
                    </div>
                    <div class="col-span-2">
                        <TextInput
                            v-model="form.complement"
                            class="mt-1 block w-full"
                            placeholder="Complemento"
                            type="text"
                            :disabled="form.processing"
                        />
                    </div>
                </div>
                <div class="flex justify-end">
                    <PrimaryButton
                        :loading="form.processing"
                    >
                        Salvar endereço
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template>
