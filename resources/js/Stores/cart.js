import { defineStore } from 'pinia';
import { computed, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import LocalStorage from '@/Services/localStorage';
import axios from 'axios';

const page = usePage();

export const useCartStore = defineStore('cart', () => {
    const cartItems = ref([]);

    const getCartItems = () => {
        if (page.props.auth.user) {
            fetchCartItemsFromBackend();
            return;
        }

        fetchCartItemsFromLocalStorage();
    };

    const fetchCartItemsFromBackend = async () => {
        const { data } = await axios.get('/carts');
        cartItems.value = data.data;
    };

    const fetchCartItemsFromLocalStorage = () => {
        cartItems.value = LocalStorage.keys().map((key) => LocalStorage.get(key));
    }

    return {
        cartItems,
        getCartItems,
    };
});
