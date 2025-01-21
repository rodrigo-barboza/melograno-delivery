<script setup>
import DishCard from '@/Pages/Establishment/Partials/DishCard.vue';

defineProps({
    sectionTitle: {
        type: String,
        default: '',
    },
});

</script>

<template>
    <div>
        <div class="text-3xl text-[#1E1E1E] font-bold">
            {{ sectionTitle }}
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <DishCard class="mt-4" />
            <DishCard class="mt-4" />
            <DishCard class="mt-4" />
            <DishCard class="mt-4" />
            <DishCard class="mt-4" />
            <DishCard class="mt-4" />
            <DishCard class="mt-4" />
        </div>
    </div>
</template>
