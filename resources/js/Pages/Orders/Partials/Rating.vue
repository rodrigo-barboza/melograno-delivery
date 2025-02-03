<script setup>
import { computed, ref } from 'vue';

const emit = defineEmits(['update:rate']);

const props = defineProps({
    rate: {
        type: Number,
        required: true,
        default: 0,
    },

    editable: {
        type: Boolean,
        default: false,
    },
});

const hoveredRate = ref(0);
const selectedRate = ref(props.rate);

const displayedRate = computed(() => (hoveredRate.value ? hoveredRate.value : selectedRate.value));

const setRate = (value) => {
    if (props.editable) {
        selectedRate.value = value;
        emit('update:rate', value);
    }
};

const setHover = (value) => {
    if (props.editable) {
        hoveredRate.value = value;
    }
};

const clearHover = () => {
    if (props.editable) {
        hoveredRate.value = 0;
    }
};
</script>

<template>
    <div
        v-if="editable || rate"
        class="mt-2 flex items-center space-x-1"
    >
        <template v-for="i in 5" :key="i">
            <svg
                class="w-5 h-5 transition-all cursor-pointer"
                :class="{
                    'text-yellow-300': i <= displayedRate,
                    'text-gray-300': i > displayedRate,
                    'hover:text-yellow-400': editable,
                }"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 22 20"
                @click="setRate(i)"
                @mouseover="setHover(i)"
                @mouseleave="clearHover"
            >
                <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
                />
            </svg>
        </template>
    </div>
    <div
        v-else
        class="mt-2 text-sm text-[#7E7E7E]"
    >
        Ainda não avaliado
    </div>
</template>
