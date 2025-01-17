<template>
    <swiper
        class="h-[240px] sm:h-[250px]"
        :modules="modules"
        :slides-per-view="slidesPerView"
        :space-between="10"
        :height="200"
        :slides-offset-before="resolveSlidesOffsetBefore"
    >
        <template v-if="items.length > 0">
            <swiper-slide
                v-for="(item, index) in items"
                :key="index"
            >
                {{ item }}
            </swiper-slide>
        </template>
        <template v-else>
            <slot />
        </template>
    </swiper>
</template>

<script setup>
import { Navigation, Pagination } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { computed, onMounted, onUnmounted, ref } from 'vue';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

defineProps({
    items: {
        type: Array,
        default: () => ({}),
    },
});

const slidesPerView = ref(6);

const modules = [Pagination, Navigation];

const resolveSlidesOffsetBefore = computed(() => {
    return slidesPerView.value < 3
        ? '10' : slidesPerView.value < 6
        ? '70' : '340';
});

const updateSlidesPerView = () => {
    const width = window.innerWidth;

    slidesPerView.value = width < 180 ? 2
        : (width < 768) ? 2
        : (width < 1024) ? 4
        : (width < 1368) ? 5
        : (width < 1440) ? 7
        : 7;
};

onMounted(() => {
    updateSlidesPerView();
    window.addEventListener('resize', updateSlidesPerView);
});

onUnmounted(() => {
    window.removeEventListener('resize', updateSlidesPerView);
});

</script>
