<script setup>
import { STATUS, WAINTING, CANCELED, IN_PREPARATION, AVAILABLE_FOR_PICKUP, COMPLETED } from '@/Constants/orderStatus';
import { computed } from 'vue';

const props = defineProps({
    status: {
        type: String,
        required: true,
    },

    deliveryType: {
        type: String,
        required: true,
    },
});

const resolveLabels = computed(() => ([
    {
        label: STATUS[WAINTING].label,
        completed: STATUS[WAINTING].level <= STATUS[props.status].level,
    },
    {
        label: STATUS[IN_PREPARATION].label,
        completed: STATUS[IN_PREPARATION].level <= STATUS[props.status].level,
    },
    {
        label: props.deliveryType === 'pickup' ? STATUS[AVAILABLE_FOR_PICKUP].label : STATUS[DELIVERING].label,
        completed: STATUS[AVAILABLE_FOR_PICKUP].level <= STATUS[props.status].level,
    },
    {
        label: props.status === CANCELED ? STATUS[CANCELED].label : STATUS[COMPLETED].label,
        completed: STATUS[COMPLETED].level <= STATUS[props.status].level,
    },
]));

const isTheLastStep = (index) => index === 3;

</script>

<template>
    <ol class="mt-2 p-4 flex justify-between">
        <li
            v-for="({ label, completed }, index) in resolveLabels"
            :key="index"
            :class="`relative ${isTheLastStep(index) ? 'w-[200px]' : 'w-full'}`"
        >
            <div class="flex items-center">
                <div
                    v-if="completed"
                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full ring-0 ring-white sm:ring-8 shrink-0"
                >
                    <svg class="w-2.5 h-2.5 text-blue-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5.917 5.724 10.5 15 1.5" />
                    </svg>
                </div>
                <div
                    v-else
                    class="z-10 flex items-center justify-center w-6 h-6 bg-gray-200 rounded-full ring-0 ring-white sm:ring-8 shrink-0"
                >
                    <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5.917 5.724 10.5 15 1.5" />
                    </svg>
                </div>
                <div
                    v-if="index !== resolveLabels.length - 1"
                    class="flex w-full bg-gray-200 h-0.5"
                >
                </div>
            </div>
            <div class="ml-[-35px] mt-3 max-w-[100px]">
                <h3 class="text-center font-medium text-gray-900">
                    {{ label }}
                </h3>
            </div>
        </li>
    </ol>
</template>
