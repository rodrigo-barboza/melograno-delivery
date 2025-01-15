<script setup>
import Sidesheet from '@/Components/Sidesheet.vue';
import EmptyState from '@/Components/EmptyState.vue';

const showCart = defineModel({
    type: Boolean,
    default: false
});

const props = defineProps({
    items: {
        type: Array,
        default: () => ([]),
    },
});

</script>

<template>
    <Sidesheet
        v-model="showCart"
        :title="!!items.length ? 'Carrinho' : ''"
    >
        <div
            v-if="!items.length"
            class="flex flex-col justify-center items-center h-full gap-3"
        >
            <EmptyState
                title="Seu carrinho está vazio"
                subtitle="Adicione itens ao seu carrinho"
                image-src="/images/empty-cart.svg"
            />
        </div>
    </Sidesheet>
</template>
