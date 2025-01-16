
<template>
    <Head title="Deu fome? Melograno" />

    <GuestLayout>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 lg:px-8">
            <div class="text-[#1E1E1E] font-bold text-2xl mb-6">Categorias</div>
        </div>
        <CategoriesSection />
        <template #container>
            <hr class="flex-1 h-px bg-gray-300 border-0">
            <section class="mt-6">
                <div class="text-[#1E1E1E] font-bold text-2xl mb-6">Estabelecimentos</div>
                <EstablishmentsSection />
            </section>
            <div class="flex items-center justify-center mt-12">
                <PrimaryButton
                    class="max-w-72"
                    :loading="false"
                >
                    Ver mais
                </PrimaryButton>
            </div>
        </template>
    </GuestLayout>
</template>

<script setup>
import CategoriesSection from '@/Pages/Components/CategoriesSection.vue';
import EstablishmentsSection from '@/Pages/Components/EstablishmentsSection.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

</script>
