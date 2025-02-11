<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import UploadInput from '@/Components/UploadInput.vue';
import { ref } from 'vue';

const emit = defineEmits(['submit']);

const form = defineModel({
    type: Object,
    required: true,
});

const unformattedPrice = ref(null);

</script>

<template>
    <form @submit.prevent>
        <div class="flex gap-4">
            <div class="flex flex-col items-center gap-2">
                <img src="/images/dish-placeholder.svg" class="object-cover rounded-xl">
                <small>Pré visualização da imagem</small>
            </div>
            <div class="min-w-[50%]">
                <div class="mt-[-14px] flex flex-col gap-2">
                    <InputLabel
                        class="mt-4"
                        value="Nome"
                    />
                    <TextInput
                        v-model="form.name"
                        type="text"
                        class="block w-full"
                        placeholder="Pastel de frango com molho"
                    />
                    <InputError :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel
                        class="mb-2"
                        value="Descrição"
                    />
                    <textarea
                        v-model="form.description"
                        class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 placeholder:text-[#AAAAAA] focus:ring-[#F34444] focus:border-[#F34444]"
                        rows="4"
                        placeholder="O pastel de frango com molho é um salgado crocante e dourado..."
                    >
                    </textarea>
                    <InputError :message="form.errors.description" />
                </div>
                <div class="mt-[-14px] flex flex-col gap-2">
                    <InputLabel
                        class="mt-4"
                        value="Nome"
                    />
                    <TextInput
                        v-model="form.price"
                        class="block w-full"
                        placeholder="R$ 24,90"
                        type="text"
                        currency
                        @unformatted-value="unformattedPrice = $event"
                    />
                    <InputError :message="form.errors.price" />
                </div>
                <div class="mt-[-14px] flex flex-col gap-2">
                    <InputLabel
                        class="mt-4"
                        value="Imagem do prato"
                    />
                    <UploadInput
                        v-model="form.image"
                        accept="image/png, image/jpeg, image/jpg"
                        class="block w-full"
                    />
                    <InputError :message="form.errors.image" />
                </div>
                <hr class="mt-4 h-px bg-gray-300 border-0">
                <PrimaryButton
                    class="mt-4 flex font-medium justify-between"
                    @click="emit('submit', unformattedPrice)"
                >
                    Adicionar
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>
