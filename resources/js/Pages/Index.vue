
<script setup>
import CategoriesSection from '@/Pages/Components/CategoriesSection.vue';
import EstablishmentsSection from '@/Pages/Components/EstablishmentsSection.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import useToast from '@/Composables/useToast';
import axios from 'axios';

defineProps({
    categories: {
        type: Array,
        default: () => ([]),
    },

    canLogin: {
        type: Boolean,
    },

    canRegister: {
        type: Boolean,
    },
});

const toast = useToast();

const establishments = ref([]);
const pagination = ref({});
const currentPage = ref(1);
const loading = ref(false);

const hasMoreEstablishmentsToLoad = computed(() => {
    return currentPage.value < pagination.value.last_page ;
});

const fetchEstablishments = async () => {
    loading.value = true;

    try {
        const { data } = await axios.get(`/establishments?page=${currentPage.value}`);
        establishments.value.push(...data.data);
        pagination.value = data.meta;
    } catch (error) {
        toast.error('Ocorreu um erro ao carregar os estabelecimentos');
    }

    loading.value = false;
};

const loadMoreEstablishments = () => {
    if (!hasMoreEstablishmentsToLoad.value) {
        return;
    }

    currentPage.value += 1;
    fetchEstablishments();
};

onMounted(fetchEstablishments);

</script>

<template>
    <Head title="Deu fome? Melograno" />
    <MainLayout>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 lg:px-8">
            <div class="text-[#1E1E1E] font-bold text-2xl mb-6">Categorias</div>
        </div>
        <CategoriesSection :categories="categories?.items" />
        <template #container>
            <hr class="flex-1 h-px bg-gray-300 border-0">
            <section class="mt-6">
                <div class="text-[#1E1E1E] font-bold text-2xl mb-6">Estabelecimentos</div>
                <EstablishmentsSection
                    :establishments="establishments"
                    :loading="loading"
                />
            </section>
            <div class="flex items-center justify-center mt-12">
                <PrimaryButton
                    v-if="hasMoreEstablishmentsToLoad"
                    class="max-w-72"
                    :loading="loading"
                    @click="loadMoreEstablishments"
                >
                    Ver mais
                </PrimaryButton>
            </div>
        </template>
    </MainLayout>
</template>
