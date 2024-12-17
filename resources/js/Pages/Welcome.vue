
<template>
    <Head title="Deu fome? Melograno" />
    <GuestLayout>
        <div class="">
            <a href="/teste">Navegar</a>
            Oii
        </div>
    </GuestLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

</script>
