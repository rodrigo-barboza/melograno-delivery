<script setup>

const model = defineModel({
    type: String,
    required: true,
});

defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },

    placeholder: {
        type: String,
        default: 'dd/mm/aaaa',
    },
});

</script>

<template>
    <div class="relative max-w-sm">
        <input
            v-model="model"
            type="date"
            class="rounded-md py-3 border border-[#CCCCCC] focus:border-[1px] placeholder:text-[#AAAAAA] focus:border-[#E8A3A3] focus:ring-[#E8A3A3] block w-full p-2.5"
            :placeholder="placeholder"
            @change="console.log($event.target.value)"
        >
    </div>
</template>
