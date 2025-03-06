<script setup>
import { computed, ref, watchEffect } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import UploadInput from '@/Components/UploadInput.vue';

const emit = defineEmits(['submit']);

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    isEdit: {
        type: Boolean,
        default: false,
    },
});

const form = defineModel({
    type: Object,
    required: true,
});

const unformattedPrice = ref(null);
const imagePreview = ref(null);

const categoriesOptions = computed(() => props.categories.map(({ id, name }) => ({ label: name, value: id })));

watchEffect(() => {
    if (form.value.image instanceof File) {
        imagePreview.value = URL.createObjectURL(form.value.image);
        return;
    }

    imagePreview.value = form.value.image ?? null;
});

</script>

<template>
    <form @submit.prevent>
        <div class="mt-6 flex gap-4">
            <div class="flex flex-col items-center gap-2 min-w-[45%]">
                <img
                    class="object-cover rounded-xl min-w-[350px] max-w-[350px] min-h-[400px] max-h-[400px]"
                    :src="imagePreview ?? '/images/dish-placeholder.svg'"
                >
                <small class="mt-2 font-semibold">Pré visualização da imagem</small>
            </div>
            <div class="min-w-[50%] flex flex-col gap-2">
                <div class="mt-[-14px] flex flex-col">
                    <InputLabel
                        class="mt-4"
                        text-size="md"
                        value="Nome"
                    />
                    <TextInput
                        v-model="form.name"
                        type="text"
                        class="block w-full"
                        placeholder="Pastel de frango com molho"
                        :disabled="form.processing"
                    />
                    <InputError :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel
                        class="mb-2"
                        text-size="md"
                        value="Categoria"
                    />
                    <SelectInput
                        v-model="form.category_id"
                        class="block w-full"
                        placeholder="Selecione a categoria"
                        :options="categoriesOptions"
                    />
                    <InputError :message="form.errors.category_id" />
                </div>
                <div>
                    <InputLabel
                        class="mb-2"
                        text-size="md"
                        value="Descrição"
                    />
                    <textarea
                        v-model="form.description"
                        class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 placeholder:text-[#AAAAAA] focus:ring-[#E8A3A3] focus:border-[#E8A3A3]"
                        placeholder="O pastel de frango com molho é um salgado crocante e dourado..."
                        rows="4"
                        :disabled="form.processing"
                    >
                    </textarea>
                    <InputError :message="form.errors.description" />
                </div>
                <div>
                    <InputLabel
                        class="mb-2"
                        text-size="md"
                        value="Preço"
                    />
                    <TextInput
                        v-model="form.price"
                        class="block w-full"
                        placeholder="R$ 24,90"
                        type="text"
                        :disabled="form.processing"
                        currency
                        @unformatted-value="unformattedPrice = $event"
                    />
                    <InputError :message="form.errors.price" />
                </div>
                <div>
                    <InputLabel
                        class="mb-2"
                        text-size="md"
                        value="Imagem do prato"
                    />
                    <UploadInput
                        v-model="form.image"
                        class="block w-full"
                        :disabled="form.processing"
                    />
                    <InputError :message="form.errors.image" />
                </div>
                <hr class="mt-4 h-px bg-gray-300 border-0">
                <div class="mt-4 flex justify-end">
                    <PrimaryButton
                        class="font-medium px-12"
                        :fluid="false"
                        :disabled="form.processing"
                        @click="emit('submit', unformattedPrice)"
                    >
                        {{ isEdit ? 'Atualizar' : 'Adicionar' }}
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </form>
</template>
