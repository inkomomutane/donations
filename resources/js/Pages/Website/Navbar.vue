<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    className: {
        type: String,
        default: "",
    },
});

const routeCampaignRoute = () => {
    return route().current("campaign.*") || route().current("web.campaigns");
};

const notRouteCampaignRoute = () => {
    return !route().current("campaign.*") || !route().current("web.campaigns");
};
</script>
<template>
    <nav
        id="default-nav"
        class="bg-emerald-50 w-full dark:border-gray-600"
        :class="className"
    >
        <div
            class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
        >
            <Link
                href="/"
                class="flex items-center space-x-2 rtl:space-x-reverse"
            >
                <svg
                    class="w-8 h-8 fill-emerald-700"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <path
                        d="M19.86 8.09c0 .15 0 .3-.01.44-1.53-.57-3.33-.22-4.53.86a4.43 4.43 0 00-2.98-1.14c-2.46 0-4.46 2.01-4.46 4.49 0 2.83 1.42 4.9 2.78 6.24-.11-.01-.2-.03-.28-.06C7.79 18.03 2 14.35 2 8.09 2 5.33 4.22 3.1 6.96 3.1c1.63 0 3.07.78 3.97 1.99A4.957 4.957 0 0114.9 3.1c2.74 0 4.96 2.23 4.96 4.99z"
                        opacity=".4"
                    ></path>
                    <path
                        d="M18 9.59c-1.07 0-2.04.52-2.64 1.32-.6-.8-1.56-1.32-2.64-1.32-1.82 0-3.3 1.48-3.3 3.32 0 .71.11 1.36.31 1.96.94 2.97 3.83 4.74 5.26 5.23.2.07.53.07.74 0 1.43-.49 4.32-2.26 5.26-5.23.2-.61.31-1.26.31-1.96 0-1.84-1.48-3.32-3.3-3.32z"
                    ></path>
                </svg>
                <span
                    class="text-emerald-800 self-center text-base font-black font-['Lexend_Deca'] whitespace-nowrap"
                >
                    Nepano
                </span>
            </Link>
            <div
                class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse font-['Anta']"
            >
                <button
                    type="button"
                    class="bg-white text-emerald-900 hover:text-white hover:bg-emerald-600 hover:border-white duration-300 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded border border-emerald-950 text-sm px-4 py-2 text-center"
                >
                    Faça uma doação
                </button>
                <button
                    data-collapse-toggle="navbar-sticky"
                    type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky"
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
            <div
                class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                id="navbar-sticky"
            >
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-bold font-['Anta'] border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0"
                >
                    <li>
                        <Link
                            href="/"
                            class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            :class="{
                                'text-emerald-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:90%_2px] bg-no-repeat':
                                    route().current('welcome'),
                                'text-gray-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:0%_2px] hover:bg-[length:90%_2px] bg-no-repeat hover:duration-500':
                                    !route().current('welcome'),
                            }"
                            aria-current="page"
                        >
                            Início</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('about')"
                            class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            :class="{
                                'text-emerald-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:90%_2px] bg-no-repeat':
                                    route().current('about'),
                                'text-gray-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:0%_2px] hover:bg-[length:90%_2px] bg-no-repeat hover:duration-500':
                                    !route().current('about'),
                            }"
                        >
                            Sobre nós
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('web.campaigns')"
                            class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            :class="{
                                'text-emerald-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:90%_2px] bg-no-repeat':
                                    routeCampaignRoute(),
                                'text-gray-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:0%_2px] hover:bg-[length:90%_2px] bg-no-repeat hover:duration-500':
                                    notRouteCampaignRoute,
                            }"
                        >
                            Campanhas
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('contact')"
                            class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            :class="{
                                'text-emerald-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:90%_2px] bg-no-repeat':
                                    route().current('contact'),
                                'text-gray-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:0%_2px] hover:bg-[length:90%_2px] bg-no-repeat hover:duration-500':
                                    !route().current('contact'),
                            }"
                        >
                            Contacto
                        </Link>
                    </li>
                    <li v-if="route().current('policy')">
                        <Link
                            :href="route('policy')"
                            class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            :class="{
                                'text-emerald-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:90%_2px] bg-no-repeat':
                                    route().current('policy'),
                                'text-gray-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:0%_2px] hover:bg-[length:90%_2px] bg-no-repeat hover:duration-500':
                                    !route().current('policy'),
                            }"
                        >
                            Política de privacidade
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
