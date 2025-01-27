import { defineStore } from 'pinia';
import { ref } from 'vue';
import axios from 'axios';
import LocalStorage from '@/Services/localStorage';
import useAuth from '@/Composables/useAuth';

const { isLoggedIn } = useAuth();

export const useCartStore = defineStore('cart', () => {
    const cartItems = ref([]);

    const getCartItems = () => {
        if (isLoggedIn()) {
            fetchCartItemsFromBackend();
            return;
        }

        fetchCartItemsFromLocalStorage();
    };

    const fetchCartItemsFromBackend = async () => {
        cartItems.value = [];

        const { data } = await axios.get('/carts');
        cartItems.value = data.data;
    };

    const fetchCartItemsFromLocalStorage = () => {
        cartItems.value = [];

        LocalStorage.keys().forEach((key) => {
            if (key.includes('cart')) {
                cartItems.value.push(LocalStorage.get(key));
            }
        });
    };

    const cleanCartFromLocalStorage = () => {
        LocalStorage.keys().forEach((key) => {
            if (key.includes('cart')) {
                LocalStorage.remove(key);
            }
        });

        cartItems.value = [];
    };

    return {
        cartItems,
        getCartItems,
        cleanCartFromLocalStorage,
    };
});
