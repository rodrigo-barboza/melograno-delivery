
<template>
    <Head title="Deu fome? Melograno" />

    <GuestLayout>
        <CategoriesSection />
        <div>
            Oii
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import CategoriesSection from '@/Pages/Components/CategoriesSection.vue';
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
