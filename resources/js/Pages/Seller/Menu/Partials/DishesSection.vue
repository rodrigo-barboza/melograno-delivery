<script setup>
import DishCard from '@/Pages/Seller/Menu/Partials/DishCard.vue';

const emit = defineEmits(['on-edit', 'on-delete']);

defineProps({
    dishes: {
        type: Array,
        required: true,
    },
});

</script>

<template>
    <section class="mt-4 flex flex-col gap-4">
        <dish-card
            v-for="(dish, index) in dishes"
            v-bind="dish"
            :key="index"
            @on-edit="emit('on-edit', dish)"
            @on-delete="emit('on-delete', dish)"
        />
    </section>
</template>
