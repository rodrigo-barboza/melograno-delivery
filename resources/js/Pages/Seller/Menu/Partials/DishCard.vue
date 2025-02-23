<script setup>
import Badge from '@/Components/Badge.vue';

defineProps({
    name: {
        type: String,
        required: true,
    },

    description: {
        type: String,
        required: true,
    },

    price: {
        type: Number,
        required: true,
    },

    image: {
        type: String,
        required: true,
    },

    category: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <div class="flex justify-between border border-[#F2F2F2] rounded-md p-2">
        <div class="flex gap-4">
            <img
                class="w-24 h-24 object-cover rounded-md border border-[#e3e3e3]"
                :src="image"
                :alt="name"
            >
            <div>
                <div>{{ name }}</div>
                <div>{{ description }}</div>
                <badge
                    :variant="category.variant"
                    :label="category.name"
                />
            </div>
            <div>price</div>
        </div>
        <div>
            actions
        </div>
    </div>
</template>
