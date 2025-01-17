<script setup>
import CategoryCard from '@/Components/CategoryCard.vue';
import Swiper from '@/Components/Swiper.vue';
import { SwiperSlide } from 'swiper/vue';

defineProps({
    categories: {
        type: Array,
        default: () => ([]),
    },
});

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
                    @on-click="console.log(slug)"
                />
            </SwiperSlide>
        </Swiper>
    </div>
</template>
