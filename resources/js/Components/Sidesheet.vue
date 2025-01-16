<template>
    <div
        ref="drawerElement"
        class="fixed z-40 h-screen w-96 bg-white p-4"
        tabindex="-1"
    >
        <h2 class="text-2xl font-bold text-gray-900">
            {{ $attrs.title ?? 'Título' }}
        </h2>
        <button
            class="absolute right-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
            @click="emit('update:model-value', false)"
        >
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="flex flex-col justify-between mt-6 mb-6 text-sm text-gray-500 h-[93%]">
            <div class="h-full">
                <slot />
            </div>
            <div>
                <slot name="footer" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { Drawer } from 'flowbite';
import { onMounted, ref, watchEffect } from 'vue';

const emit = defineEmits(['update:model-value']);

const show = defineModel({
    type: Boolean,
    default: false,
});

const drawerElement = ref(null);
const drawer = ref(null);

watchEffect(() => {
    if (show.value) {
        drawer.value?.show();
        return;
    }

    drawer.value?.hide();
});

onMounted(() => {
    drawer.value = new Drawer(drawerElement.value, {
        placement: 'right',
        backdropClasses: 'bg-black/30 fixed inset-0 z-30',
        onHide: () => {
            emit('update:model-value', false);
        },
    });
});

</script>
