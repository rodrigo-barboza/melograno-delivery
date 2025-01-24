<script setup>
import { computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DishForm from '@/Pages/Establishment/Partials/DishForm.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useCart from '@/Composables/useCart';
import useCurrency from '@/Composables/useCurrency';

const emit = defineEmits(['update:model-value']);

const { addDishToCart } = useCart();
const { toCurrency } = useCurrency();

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
    dish: null,
    quantity: 1,
    comment: '',
});

const totalPrice = computed(() => toCurrency(props.dish.price * form.quantity));

const closeModal = () => (emit('update:model-value', false), form.reset());

const onSubmit = async () => {
    form.dish_id = props.dish.id;
    form.dish = props.dish;

    await addDishToCart(form.data());
    closeModal();
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
                    @click="onSubmit"
                >
                    Adicionar <span>{{ totalPrice }}</span>
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>
