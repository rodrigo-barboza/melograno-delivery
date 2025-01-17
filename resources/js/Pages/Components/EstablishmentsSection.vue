<script setup>
import EstablishmentCard from '@/Pages/Components/EstablishmentCard.vue';
import EstabilshmentCardSkeleton from '@/Pages/Components/EstablishmentCardSkeleton.vue';

defineProps({
    establishments: {
        type: Array,
        default: () => ([]),
    },

    loading: {
        type: Boolean,
        default: false
    },
});

</script>

<template>
    <div class="grid grid-cols-1 lg:grid-cols-3 sm:grid-cols-2 gap-4">
        <template v-if="establishments.length === 0">
            <EstabilshmentCardSkeleton
                v-for="index in 15"
                :key="index"
            />
        </template>
        <template v-else>
            <EstablishmentCard
                v-for="(establishment, index) in establishments"
                v-bind="establishment"
                :loading="loading"
                :key="index"
            />
        </template>
    </div>
</template>
