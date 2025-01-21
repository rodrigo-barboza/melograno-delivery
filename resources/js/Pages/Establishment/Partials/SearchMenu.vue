<script setup>
const emit = defineEmits(['search']);

defineProps({
    deliveryAverageTime: {
        type: String,
        default: '',
    },
});

</script>

<template>
    <div class="mt-4 flex gap-2 justify-between">
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg
                    class="w-4 h-4 text-gray-500"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 20"
                >
                    <path
                        stroke="#F34444"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                    />
                </svg>
                <span class="sr-only">Search icon</span>
            </div>
            <input
                type="text"
                id="search-navbar"
                class="block w-full p-2 ps-10 text-sm text-gray-900 border-none h-12 rounded-lg bg-[#F8F8F8] focus:ring-[#F34444] focus:border-[#F34444] placeholder:text-[#C5C5C5]"
                placeholder="Buscar no menu"
                @change="emit('search', $event.target.value)"
            >
        </div>
        <div class="min-w-[150px] bg-[#F8F8F8] text-sm font-normal rounded-lg py-1 px-4">
            <div>Entrega</div>
            <div class="text-[#A6A6A5] font-[400]">
                {{ deliveryAverageTime }}
            </div>
        </div>
    </div>
</template>
