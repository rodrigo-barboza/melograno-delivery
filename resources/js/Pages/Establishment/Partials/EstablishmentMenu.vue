<script setup>
import SearchMenu from '@/Pages/Establishment/Partials/SearchMenu.vue';
import MenuList from '@/Pages/Establishment/Partials/MenuList.vue';

defineProps({
    deliveryAverageTime: {
        type: String,
        default: '',
    },

    dishes: {
        type: Array,
        default: [],
    },
});

</script>

<template>
    <div>
        <SearchMenu
            :delivery-average-time="deliveryAverageTime"
            @search="console.log($event)"
        />
        <div class="mt-12 flex flex-col gap-12">
            <MenuList
                section-title="Comidas"
                :dishes="[]"
            />
            <MenuList
                section-title="Bebidas"
                :dishes="[]"
            />
        </div>
    </div>
</template>
