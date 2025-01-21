<script setup>
import SearchMenu from '@/Pages/Establishment/Partials/SearchMenu.vue';
import MenuList from '@/Pages/Establishment/Partials/MenuList.vue';
import { computed, ref } from 'vue';
import EmptyState from '@/Components/EmptyState.vue';

const props = defineProps({
    deliveryAverageTime: {
        type: String,
        default: '',
    },

    dishes: {
        type: Array,
        default: () => ([]),
    },
});

const internalDishes = ref(props.dishes);
const searchValue = ref('');

const menu = computed(() => ({
    drinks: internalDishes.value.filter((dish) => dish.category.slug === 'drinks'),
    foods: internalDishes.value.filter((dish) => dish.category.slug !== 'drinks'),
}));

const onSearchByName = (value) => {
    searchValue.value = value.toLowerCase();
    internalDishes.value = props.dishes.filter(
        (dish) => dish.name.toLowerCase().includes(searchValue.value),
    );
};

</script>

<template>
    <div>
        <SearchMenu
            :delivery-average-time="deliveryAverageTime"
            @search="onSearchByName"
        />
        <div class="mt-12 flex flex-col gap-12">
            <EmptyState
                v-if="internalDishes.length === 0 && !searchValue"
                title="Nenhum item cadastrado"
                subtitle="Não foram encontrados pratos para este estabelecimento"
                image-src="/images/empty-menu.png"
                margin-title="mt-0 mb-4"
            />
            <template v-else>
                <MenuList
                    section-title="Comidas"
                    :dishes="menu.foods"
                    @on-click="$emit('on-dish-click', $event)"
                />
                <MenuList
                    section-title="Bebidas"
                    :dishes="menu.drinks"
                    @on-click="$emit('on-dish-click', $event)"
                />
            </template>
        </div>
    </div>
</template>
