<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { useCartStore } from '@/Stores/cart';
import AddressModal from '@/Pages/Components/AddressModal.vue';
import CartSidesheet from '@/Components/CartSidesheet.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const store = useCartStore();

const showCart = ref(false);
const showAddressModal = ref(false);

const fetchCartItems = () => store.getCartItems();

onMounted(() => {
    window.Echo.channel('cart').listen('.cart.updated', () => setTimeout(() => fetchCartItems(), 1000));
    setTimeout(() => fetchCartItems(), 1000);
});

</script>

<template>
    <nav class="relative bg-white border-gray-200 border-b border-[rgba(0,0,0,0.14)]">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 py-6">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="/images/melograno-inline.svg" class="h-12" />
            </a>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto order-2 md:order-2" id="navbar-search">
                <div class="relative mt-3 md:hidden">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg
                            class="w-4 h-4 text-gray-500"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 20 20"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                            />
                        </svg>
                    </div>
                    <input
                        type="text"
                        id="search-navbar"
                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search..."
                    >
                </div>
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <Link
                            :href="route('index')"
                            class="block py-2 px-3 rounded md:bg-transparent md:p-0 hover:text-[#F34444]"
                            :class="{ 'text-white bg-[#F34444] md:text-[#F34444]': route().current('index') }"
                        >
                            Home
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('establishments.index')"
                            class="block py-2 px-3 rounded md:bg-transparent md:p-0 hover:text-[#F34444]"
                            :class="{ 'text-white bg-[#F34444] md:text-[#F34444]': route().current('establishments.index') }"
                        >
                            Restaurantes
                        </Link>
                    </li>
                </ul>
            </div>
            <div class="flex md:order-3">
                <div>
                    <button
                        type="button"
                        data-collapse-toggle="navbar-search"
                        aria-controls="navbar-search"
                        aria-expanded="false"
                        class="md:hidden text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg text-sm p-2.5 me-1"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 20 20"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                            />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                    <div class="relative hidden md:block">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg
                                class="w-4 h-4 text-gray-500"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    stroke="#F34444"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                />
                            </svg>
                            <span class="sr-only">Search icon</span>
                        </div>
                        <input
                            type="text"
                            id="search-navbar"
                            class="block w-full sm:w-[300px] p-2 ps-10 text-sm text-gray-900 border-none h-12 rounded-lg bg-[#F8F8F8] focus:ring-[#F34444] focus:border-[#F34444] placeholder:text-[#C5C5C5]"
                            placeholder="Pesquisar estabelecimentos"
                        >
                    </div>
                    <button
                        data-collapse-toggle="navbar-search"
                        type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        aria-controls="navbar-search"
                        aria-expanded="false"
                    >
                        <span class="sr-only">Open main menu</span>
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 17 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex gap-4 md:order-3">
                <div>
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button
                                type="button"
                                class="flex gap-2 items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                            >
                                <img src="/icons/user.svg" class="h-6">
                            </button>
                        </template>

                        <template #content>
                            <template v-if="$page.props.auth.user">
                                <DropdownLink
                                    :href="route('orders.index')"
                                >
                                    Meus pedidos
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('profile.edit')"
                                >
                                    Perfil
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Sair
                                </DropdownLink>
                            </template>
                            <template v-else>
                                <DropdownLink
                                    :href="route('login')"
                                >
                                    Entrar
                                </DropdownLink>
                            </template>
                        </template>
                    </Dropdown>
                </div>
                <div
                    class="inline-flex items-center cursor-pointer"
                    @click="showCart = true"
                >
                    <img src="/icons/cart.svg" class="h-6">
                    <span
                        class="inline-flex items-center justify-center w-4 h-4 mt-3 ms-[-9px] text-xs font-semibold text-white bg-[#F34444] rounded-full"
                    >
                        {{ store.cartItems.length }}
                    </span>
                </div>
            </div>
        </div>
        <CartSidesheet
            v-model="showCart"
            :cart-items="store.cartItems"
            @show-address-modal="showAddressModal = true"
        />
        <AddressModal v-model="showAddressModal" />
    </nav>
</template>
