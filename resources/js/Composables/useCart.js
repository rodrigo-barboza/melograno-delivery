import useToast from '@/Composables/useToast';
import LocalStorage from '@/Services/localStorage';
import { useCartStore } from '@/Stores/cart';
import axios from 'axios';
import useAuth from './useAuth';

export default () => {
    const { isLoggedIn } = useAuth();
    const store = useCartStore();
    const toast = useToast();

    const storeDishOnLocalStorage = (form) => LocalStorage.set(`cart-${form.dish_id}`, form);
    const storeDishOnBackend = (form) => axios.post('/carts', form);
    const resolveStoreDishAction = async (form) => (isLoggedIn() ? storeDishOnBackend(form) : storeDishOnLocalStorage(form));
    const addDishToCart = async (form) => {
        try {
            await resolveStoreDishAction(form);
            toast.success('Produto adicionado ao carrinho');
            store.getCartItems();
        } catch (error) {
            toast.error('Ocorreu um erro ao adicionar o produto ao carrinho.');
        }
    };

    const removeFromBackend = (cartId) => axios.delete(`/carts/${cartId}`);
    const removeFromLocalStorage = (dishId) => LocalStorage.remove(`cart-${dishId}`);
    const resolveRemoveAction = (dishId, cartId) => (isLoggedIn() ? removeFromBackend(cartId) : removeFromLocalStorage(dishId));
    const removeDishFromCart = async (dishId, cartId) => {
        try {
            await resolveRemoveAction(dishId, cartId);
            toast.success('Produto removido do carrinho');
            store.getCartItems();
        } catch (error) {
            toast.error('Ocorreu um erro ao remover o produto do carrinho.');
        }
    };

    const updateQuantityFromBackend = (cartId, quantity) => axios.patch(`/carts/${cartId}`, { quantity });
    const updateQuantityFromLocalStorage = (dishId, quantity) => {
        const cartItem = LocalStorage.get(`cart-${dishId}`);
        cartItem.quantity = quantity;
        LocalStorage.set(`cart-${dishId}`, cartItem);
    };
    const resolveUpdateAction = (dishId, quantity, cartId) => (isLoggedIn()
        ? updateQuantityFromBackend(cartId, quantity)
        : updateQuantityFromLocalStorage(dishId, quantity)
    );
    const updateQuantityFromDishOnCart = async (dishId, quantity, cartId) => resolveUpdateAction(dishId, quantity, cartId);

    return {
        addDishToCart,
        removeDishFromCart,
        updateQuantityFromDishOnCart,
    };
};
