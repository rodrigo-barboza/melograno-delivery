<script setup>
import CategoryCard from '@/Components/CategoryCard.vue';
import Swiper from '@/Components/Swiper.vue';
import { SwiperSlide } from 'swiper/vue';

defineProps({
    categories: {
        type: Array,
        default: () => ([
            {
                name: 'Hamburguesas',
                image: '/images/hamburger.webp',
            },
            {
                name: 'Pizzas',
                image: '/images/hamburger.webp',
            },
            {
                name: 'Hamburguesas',
                image: '/images/hamburger.webp',
            },
            {
                name: 'Hamburguesas',
                image: '/images/hamburger.webp',
            },
            {
                name: 'Pizzas',
                image: '/images/hamburger.webp',
            },
            {
                name: 'Hamburguesas',
                image: '/images/hamburger.webp',
            },
            {
                name: 'Hamburguesas',
                image: '/images/hamburger.webp',
            },
        ]),
    },
});

</script>

<template>
    <div class="">
        <Swiper>
            <SwiperSlide
                v-for="{ id, name, image } in categories"
                :key="id"
            >
                <CategoryCard
                    :id="id"
                    :name="name"
                    :image="image"
                    @on-click="console.log('opa')"
                />
            </SwiperSlide>
        </Swiper>
    </div>
</template>
