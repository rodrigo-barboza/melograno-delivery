<script setup>
import { Head } from '@inertiajs/vue3';
import GuestLightLayout from '@/Layouts/GuestLightLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <GuestLightLayout container-size="sm:max-w-5xl">
        <Head title="Pagamento confirmado" />
        <div class="flex flex-col gap-4 sm:flex-row justify-center">
            <div class="mt-12 flex flex-col gap-2">
                <img class="self-center" src="/images/cancel.png" width="250">
                <h2 class="self-center text-center mt-6 text-2xl font-bold">Pagamento cancelado</h2>
                <p class="self-center text-center text-base text-[#7E7E7E]">Para continuar com o pagamento acesse sua<br/>página de pedidos.</p>
                <PrimaryButton
                    class="mt-4"
                    @click="$inertia.visit(route('orders.index'))"
                >
                    Ir para meus pedidos
                </PrimaryButton>
            </div>
        </div>
    </GuestLightLayout>
</template>
