<script setup>
import DishCard from '@/Pages/Establishment/Partials/DishCard.vue';

defineProps({
    sectionTitle: {
        type: String,
        default: '',
    },

    dishes: {
        type: Array,
        default: () => ([]),
    },
});

</script>

<template>
    <div>
        <div class="text-3xl text-[#1E1E1E] font-bold">
            {{ sectionTitle }}
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <template v-if="dishes.length === 0">
                Nenhum item encontrado nesta categoria
            </template>
            <template v-else>
                <DishCard
                    v-for="(dish, index) in dishes"
                    v-bind="dish"
                    :key="index"
                    class="mt-4"
                    @on-click="$emit('on-click', dish)"
                />
            </template>
        </div>
    </div>
</template>
