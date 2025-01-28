<script setup>
defineProps({
    addresses: {
        type: Array,
        required: true,
    },

    isPickup: {
        type: Boolean,
        required: true,
    },
});

</script>

<template>
    <div
        v-for="(address, index) in addresses"
        :key="index"
        class="flex gap-4 border border-[#F2F2F2] rounded-xl p-6 text-[#7E7E7E] mb-4"
    >
        <img src="/icons/pin.svg" class="self-start w-8">
        <div class="font-[500] space-y-1">
            <div v-if="isPickup">Endereço para retirada</div>
            <div v-else>Endereço de entrega</div>
            <div class="font-light">{{ address }}</div>
        </div>
    </div>
</template>
