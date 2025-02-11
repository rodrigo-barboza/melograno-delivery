<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import { useCartStore } from '@/Stores/cart';
import AddressModal from '@/Pages/Components/AddressModal.vue';
import CartSidesheet from '@/Components/CartSidesheet.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import axios from 'axios';

const store = useCartStore();

const showCart = ref(false);
const showAddressModal = ref(false);
const search = ref(null);
const searchTimeout = ref(null);
const searchResults = ref([]);
const searchLoading = ref(false);

const fetchCartItems = () => store.getCartItems();

watch(search, () => {
    searchLoading.value = true;
    clearTimeout(searchTimeout.value);
    searchTimeout.value = setTimeout(() => fetchEstablishments(), 800);
});

onMounted(() => {
    window.Echo.channel('cart').listen('.cart.updated', () => setTimeout(() => fetchCartItems(), 1000));
    setTimeout(() => fetchCartItems(), 1000);
});

const fetchEstablishments = async () => {
    try {
        const { data: { establishments } } = await axios.get('/search-establishments', { params: { search: search.value } });
        searchResults.value = establishments;
    } catch (error) {
        console.log(error);
    } finally {
        searchLoading.value = false;
    }
};

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
                        v-model="search"
                        type="text"
                        id="search-navbar"
                        class="block w-full sm:w-[300px] p-2 ps-10 text-sm text-gray-900 border-none h-12 rounded-lg bg-[#F8F8F8] focus:ring-[#F34444] focus:border-[#F34444] placeholder:text-[#C5C5C5]"
                        placeholder="Pesquisar estabelecimentos"
                        autocomplete="off"
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
                            :href="route('establishments.by-category', { 'slug_category': 'restaurant'})"
                            class="block py-2 px-3 rounded md:bg-transparent md:p-0 hover:text-[#F34444]"
                            :class="{ 'text-white bg-[#F34444] md:text-[#F34444]': route().current('establishments.by-category', {'slug_category': 'restaurant'}) }"
                        >
                            Restaurantes
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('establishments.by-category', {'slug_category': 'pizzeria'})"
                            class="block py-2 px-3 rounded md:bg-transparent md:p-0 hover:text-[#F34444]"
                            :class="{ 'text-white bg-[#F34444] md:text-[#F34444]': route().current('establishments.by-category', {'slug_category': 'pizzeria'}) }"
                        >
                            Pizzarias
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('establishments.by-category', {'slug_category': 'snack-bar'})"
                            class="block py-2 px-3 rounded md:bg-transparent md:p-0 hover:text-[#F34444]"
                            :class="{ 'text-white bg-[#F34444] md:text-[#F34444]': route().current('establishments.by-category', {'slug_category': 'snack-bar'}) }"
                        >
                            Lanchonetes
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('establishments.by-category', {'slug_category': 'bar'})"
                            class="block py-2 px-3 rounded md:bg-transparent md:p-0 hover:text-[#F34444]"
                            :class="{ 'text-white bg-[#F34444] md:text-[#F34444]': route().current('establishments.by-category', {'slug_category': 'bar'}) }"
                        >
                            Bares
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
                            v-model="search"
                            type="text"
                            id="search-navbar"
                            class="block w-full sm:w-[300px] p-2 ps-10 text-sm text-gray-900 border-none h-12 rounded-lg bg-[#F8F8F8] focus:ring-[#F34444] focus:border-[#F34444] placeholder:text-[#C5C5C5]"
                            placeholder="Pesquisar estabelecimentos"
                            autocomplete="off"
                        >
                        <div
                            v-if="search"
                            class="absolute z-10 rounded-xl text-[#7E7E7E] border border-[#F2F2F2] bg-white rounded w-full sm:w-[300px] space-y-4 pt-4 pb-2"
                        >
                            <div
                                v-if="searchLoading"
                                class="flex items-center justify-center mb-2"
                            >
                                <svg
                                    class="inline w-6 h-6 me-3 text-white animate-spin"
                                    viewBox="0 0 100 101"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <template v-else-if="!!searchResults.length">
                                <div class="flex flex-col">
                                    <Link
                                        v-for="(establishment, index) in searchResults"
                                        class="hover:bg-[#F2F2F2] cursor-pointer px-4 py-2 text-ellipsis overflow-hidden whitespace-nowrap w-full sm:max-w-[300px]"
                                        :key="index"
                                        :href="route('establishments.show', establishment.id)"
                                    >
                                        {{ establishment.name }}
                                    </Link>
                                </div>
                            </template>
                            <div
                                v-else
                                class="px-4 py-2"
                            >
                                Nenhum resultado encontrado
                            </div>
                        </div>
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
                                    Entrar/Cadastrar
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
