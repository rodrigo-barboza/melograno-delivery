<script setup>
import useCurrency from '@/Composables/useCurrency';

const { toCurrency } = useCurrency();

defineProps({
    name: {
        type: String,
        default: '',
    },

    image: {
        type: String,
        default: '',
    },

    description: {
        type: String,
        default: '',
    },

    price: {
        type: Number,
        default: 0,
    },
});

</script>

<template>
    <div class="flex gap-6 text-[#1E1E1E] rounded-xl border border-[#F2F2F2] p-6 cursor-pointer hover:bg-[#F2F2F2]">
        <img
            class="w-44 h-40 object-cover rounded-xl"
            src="https://blog.ceraflame.com.br/wp-content/uploads/2021/06/Pizza-Napolitana-CERAFLAME-500x375.jpg"
        >
            <!-- :src="cover" -->
        <div class="flex flex-col justify-between gap-2">
            <div class="flex flex-col gap-2">
                <div class="text-xl font-semibold text-[#1E1E1E] text-ellipsis overflow-hidden whitespace-nowrap max-w-80">
                    Esfirra classica testando o nome grande demais branco texto
                </div>
                <div class="text-lg font-light text-[#1E1E1E]">
                    Faça as contas e economize! Escolha 8 Bib’sfihas nos sabores de: Carne, Calabresa com Mussarela ou Frango. Peça já!
                </div>
            </div>
            <div class="text-base">
                R$ 20,00    
            </div>
        </div>
    </div>
</template>
