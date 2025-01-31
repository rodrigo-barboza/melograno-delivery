<script setup>
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import CartItem from '@/Components/CartItem.vue';
import EmptyState from '@/Components/EmptyState.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Sidesheet from '@/Components/Sidesheet.vue';
import useCart from '@/Composables/useCart';
import useCurrency from '@/Composables/useCurrency';
import useAuth from '@/Composables/useAuth';

const { isLoggedIn, hasAddress } = useAuth();
const { removeDishFromCart, updateQuantityFromDishOnCart } = useCart();
const { toCurrency } = useCurrency();

const emit = defineEmits(['show-address-modal']);

const showCart = defineModel({
    type: Boolean,
    default: false
});

const props = defineProps({
    cartItems: {
        type: Array,
        default: () => ([]),
    },
});

const totalPriceProducts = computed(() => {
   return props.cartItems.reduce((total, cartItem) => total + (cartItem.dish.price * cartItem.quantity), 0);
});

const handleOrderContinue = () => {
    if (!isLoggedIn()) {
        router.visit('/login');
        showCart.value = false;
        return;
    }

    if (!hasAddress()) {
        emit('show-address-modal');
        return;
    }

    showCart.value = false;
    router.visit('/checkout');
};

</script>

<template>
    <Sidesheet
        v-model="showCart"
        :title="!!cartItems.length ? 'Carrinho' : ''"
    >
        <div
            v-if="!cartItems.length"
            class="flex flex-col justify-center items-center h-full gap-3"
        >
            <EmptyState
                title="Seu carrinho está vazio"
                subtitle="Adicione itens ao seu carrinho"
                image-src="/images/empty-cart.svg"
            />
        </div>
        <div
            v-else
            class="flex pe-4 flex-col gap-4 h-full overflow-y-auto scrollbar scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100"
        >
            <CartItem
                v-for="(cartItem, index) in cartItems"
                v-bind="cartItem"
                :key="index"
                @on-remove="removeDishFromCart"
                @on-update-quantity="updateQuantityFromDishOnCart"
            />
            <div
                class="self-center cursor-pointer hover:underline"
                @click="showCart = false"
            >
                Adicionar mais produtos
            </div>
        </div>
        <template #footer>
            <div v-if="cartItems.length > 0">
                <hr class="flex-1 h-px bg-gray-300 border-0 mb-4">
                <div class="flex flex-col gap-2">
                    <div class="flex px-2 justify-between">
                        <div>{{ cartItems.length }} {{ cartItems.length === 1 ? 'produto' : 'produtos' }}</div>
                        <div>{{ toCurrency(totalPriceProducts) }}</div>
                    </div>
                    <div class="flex px-2 justify-between">
                        <div>Taxa de entrega</div>
                        <div>A calcular</div>
                    </div>
                </div>
                <hr class="my-4 flex-1 h-px bg-gray-300 border-0">
                <div class="flex px-2 justify-between">
                    <div>Total a pagar</div>
                    <div>{{ toCurrency(totalPriceProducts) }}</div>
                </div>
                <PrimaryButton
                    class="mt-6"
                    @click="handleOrderContinue"
                >
                    Continuar
                </PrimaryButton>
            </div>
        </template>
    </Sidesheet>
</template>
