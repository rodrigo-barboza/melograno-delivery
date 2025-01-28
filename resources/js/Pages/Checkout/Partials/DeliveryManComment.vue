<script setup>
const model = defineModel({ type: String });
</script>

<template>
    <div class="flex gap-4 border border-[#F2F2F2] rounded-xl p-6 text-[#7E7E7E] mb-4">
        <img src="/icons/motorcycle.svg" class="self-start w-8">
        <div class="w-full font-[500] space-y-1">
            <div class="mb-2">Instruções para o entregador</div>
            <textarea
                v-model="model"
                class="font-light resize-none p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-[#F34444] focus:border-[#F34444]"
                rows="4"
                placeholder="Ex: duplex ao lado da casa amarela."
            />
        </div>
    </div>
</template>
