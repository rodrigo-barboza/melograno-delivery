<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';

const emit = defineEmits(['on-new-dish']);

</script>

<template>
    <div class="flex justify-between">
        <h2 class="text-[#1E1E1E] font-bold text-3xl mb-6">Cardápio</h2>
        <PrimaryButton
            class="self-center w-fit"
            :fluid="false"
            @click="emit('on-new-dish')"
        >
            Adicionar prato
        </PrimaryButton>
    </div>
</template>
