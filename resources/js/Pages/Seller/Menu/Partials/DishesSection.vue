<script setup>
import DishCard from '@/Pages/Seller/Menu/Partials/DishCard.vue';

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
        />
    </section>
</template>
