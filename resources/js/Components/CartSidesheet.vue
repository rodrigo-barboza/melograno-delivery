<script setup>
import Sidesheet from '@/Components/Sidesheet.vue';
import EmptyState from '@/Components/EmptyState.vue';

const showCart = defineModel({
    type: Boolean,
    default: false
});

defineProps({
    cartItems: {
        type: Array,
        default: () => ([]),
    },
});

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
        <div v-else>
            {{ cartItems }}
        </div>
    </Sidesheet>
</template>
