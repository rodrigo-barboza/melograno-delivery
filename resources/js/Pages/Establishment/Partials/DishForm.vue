<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PriceQuantityInput from '@/Components/PriceQuantityInput.vue';
import useCurrency from '@/Composables/useCurrency';

const { toCurrency } = useCurrency();

const form = defineModel({
    type: Object,
    required: true,
});

defineProps({
    dish: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <form @submit.prevent>
        <div class="mt-4 flex justify-between">
            <div class="text-[#5E6260] font-bold">
                {{  toCurrency(dish.price) }}
            </div>
            <PriceQuantityInput v-model="form.quantity" />
        </div>
        <!-- Tabela de adicionais será uma feature futura -->
        <InputLabel
            class="mt-4 mb-2"
            value="Comentário"
        />
        <textarea
            v-model="form.comment"
            class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-[#F34444] focus:border-[#F34444]"
            rows="4"
            placeholder="Ex: sem cebola e salada."
        >
        </textarea>
        <hr class="mt-4 h-px bg-gray-300 border-0">
    </form>
</template>
