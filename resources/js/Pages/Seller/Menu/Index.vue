<script setup>
import { router, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import ConfirmModal from '@/Components/ConfirmModal.vue';
import DishesSection from '@/Pages/Seller/Menu/Partials/DishesSection.vue';
import EditDishModal from '@/Pages/Seller/Menu/Partials/EditDishModal.vue';
import MenuHeader from '@/Pages/Seller/Menu/Partials/MenuHeader.vue';
import NewDishModal from '@/Pages/Seller/Menu/Partials/NewDishModal.vue';
import SellerLayout from '@/Layouts/SellerLayout.vue';
import useToast from '@/Composables/useToast';

const toast = useToast();

const props = defineProps({
    dishes: {
        type: Array,
        required: true,
    },

    categories: {
        type: Array,
        required: true,
    },
});

const openNewDishModal = ref(false);
const openEditDishModal = ref(false);
const openDeleteDishModal = ref(false);
const currentDish = ref(null);

const onDeleteDish = async () => {
    try {
        await axios.delete(route('seller.menu.destroy', currentDish.value.id));
        toast.success('Prato excluido com sucesso');
        openDeleteDishModal.value = false;
        router.visit('/seller/menu');
    } catch (message) {
        toast.error(message ?? 'Ocorreu um erro ao tentar excluir o prato');
    }
};

</script>

<template>
    <Head title="Cardápio" />
    <SellerLayout>
        <template #container>
            <MenuHeader @on-new-dish="openNewDishModal = true" />
            <DishesSection
                :dishes="dishes"
                @on-edit="(openEditDishModal = true, currentDish = $event)"
                @on-delete="(openDeleteDishModal = true, currentDish = $event)"
            />
            <NewDishModal
                v-model="openNewDishModal"
                :categories="categories"
            />
            <EditDishModal
                v-model="openEditDishModal"
                :categories="categories"
                :dish="currentDish"
            />
            <ConfirmModal
                v-model="openDeleteDishModal"
                :title="`Tem certeza que deseja excluir o prato: ${currentDish?.name}?`"
                description="Ao confirmar, o prato será excluido permanentemente"
                confirm-text="Excluir"
                @on-confirm="onDeleteDish"
            />
        </template>
    </SellerLayout>
</template>
