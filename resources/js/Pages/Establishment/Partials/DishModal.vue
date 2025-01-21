<script setup>
import useCurrency from '@/Composables/useCurrency';
import useToast from '@/Composables/useToast';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import DishForm from '@/Pages/Establishment/Partials/DishForm.vue';
import LocalStorage from '@/Services/localStorage';
import { useCartStore } from '@/Stores/cart';
import { computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';

const emit = defineEmits(['update:model-value']);

const { toCurrency } = useCurrency();

const store = useCartStore();
const page = usePage();
const toast = useToast();

const show = defineModel({
    type: Boolean,
    default: false,
});

const props = defineProps({
    dish: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    dish_id: null,
    quantity: 1,
    comment: '',
});

const totalPrice = computed(() => toCurrency(props.dish.price * form.quantity));

const storeOnLocalStorage = () => {
    LocalStorage.set(props.dish.id, form.data());
};

const storeOnBackend = () => {
    return axios.post('/carts', form.data());
};

const resolveStoreAction = async () => (page.props.auth?.user ? storeOnBackend() : storeOnLocalStorage());

const closeModal = () => (emit('update:model-value', false), form.reset());

const submit = async () => {
    form.dish_id = props.dish.id;

    try {
        await resolveStoreAction();
        toast.success('Produto adicionado ao carrinho');
        store.getCartItems();
        closeModal();
    } catch (error) {
        toast.error('Ocorreu um erro ao adicionar o produto ao carrinho.');
    }
};

</script>

<template>
    <Modal
        :show="show"
        @close="closeModal"
    >
        <div class="flex gap-4 w-full">
            <img
                class="max-w-[300px] min-h-[350px] object-cover rounded-md border border-[#e3e3e3]"
                :src="dish.image"
                :alt="dish.name"
            >
            <div class="flex flex-col gap-4">
                <div>
                    <div class="text-2xl font-bold">
                        {{ dish.name }}
                    </div>
                    <div class="mt-2 text-lg font-light">
                        {{ dish.description }}
                    </div>
                    <DishForm
                        v-model="form"
                        :dish="dish"
                    />
                </div>
                <PrimaryButton
                    class="mt-4 flex font-medium justify-between"
                    @click="submit"
                >
                    Adicionar <span>{{ totalPrice }}</span>
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>
