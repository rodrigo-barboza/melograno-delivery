<script setup>
import { Head } from '@inertiajs/vue3';
import EstablishmentsSection from '@/Pages/Components/EstablishmentsSection.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { computed } from 'vue';

const props = defineProps({
    establishments: {
        type: Array,
        required: true,
    },
});

const category = computed(() => props.establishments.data[0]?.category);

</script>

<template>
    <Head :title="category?.name" />
    <MainLayout>
        <template #container>
            <section class="mt-6">
                <div class="text-[#1E1E1E] font-bold text-2xl mb-6">Estabelecimentos</div>
                <EstablishmentsSection
                    :establishments="establishments.data"
                    :loading="loading"
                />
            </section>
        </template>
    </MainLayout>
</template>
