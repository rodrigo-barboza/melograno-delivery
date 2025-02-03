<script setup>
import { router } from '@inertiajs/vue3';
import { SwiperSlide } from 'swiper/vue';
import CategoryCard from '@/Components/CategoryCard.vue';
import Swiper from '@/Components/Swiper.vue';

defineProps({
    categories: {
        type: Array,
        default: () => ([]),
    },
});

const redirectToCategory = (slug) => router.visit(route('categories.index', { slug_category: slug }));
</script>

<template>
    <div>
        <Swiper>
            <SwiperSlide
                v-for="{ id, name, slug, cover } in categories"
                :key="id"
            >
                <CategoryCard
                    :id="id"
                    :name="name"
                    :image="cover"
                    @on-click="redirectToCategory(slug)"
                />
            </SwiperSlide>
        </Swiper>
    </div>
</template>
