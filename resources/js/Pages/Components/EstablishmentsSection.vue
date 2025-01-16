<script setup>
import EstablishmentCard from '@/Pages/Components/EstablishmentCard.vue';

defineProps({
    establishments: {
        type: Array,
        default: () => ([
            {
                name: 'Melograno',
                cover: '/images/habibs.jpg',
                category: 'Hamburgueria',
                rating: 4.5,
                deliveryAverageTime: '20 - 30 min',
            },
            {
                name: 'Melograno',
                cover: '/images/habibs.jpg',
                category: 'Hamburgueria',
                rating: 4.5,
                deliveryAverageTime: '20 - 30 min',
            },
            {
                name: 'Melograno',
                cover: '/images/habibs.jpg',
                category: 'Hamburgueria',
                rating: 4.5,
                deliveryAverageTime: '20 - 30 min',
            },
            {
                name: 'Melograno',
                cover: '/images/habibs.jpg',
                category: 'Hamburgueria',
                rating: 4.5,
                deliveryAverageTime: '20 - 30 min',
            },
            {
                name: 'Melograno',
                cover: '/images/habibs.jpg',
                category: 'Hamburgueria',
                rating: 4.5,
                deliveryAverageTime: '20 - 30 min',
            },
            {
                name: 'Melograno',
                cover: '/images/habibs.jpg',
                category: 'Hamburgueria',
                rating: 4.5,
                deliveryAverageTime: '20 - 30 min',
            },
            {
                name: 'Melograno',
                cover: '/images/habibs.jpg',
                category: 'Hamburgueria',
                rating: 4.5,
                deliveryAverageTime: '20 - 30 min',
            },
            {
                name: 'Melograno',
                cover: '/images/habibs.jpg',
                category: 'Hamburgueria',
                rating: 4.5,
                deliveryAverageTime: '20 - 30 min',
            },
        ]),
    },
});

</script>

<template>
    <div class="grid grid-cols-1 lg:grid-cols-3 sm:grid-cols-2 gap-4">
        <EstablishmentCard
            v-for="(establishment, index) in establishments"
            v-bind="establishment"
            :key="index"
        />
    </div>
</template>
