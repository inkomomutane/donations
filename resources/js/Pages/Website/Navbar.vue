<script setup>
import ApplicationLogo from "@components/ApplicationLogo.vue";
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
            <a
                href="/"
                class="flex items-center space-x-2 rtl:space-x-reverse"
            >
              <ApplicationLogo  className="w-8 h-auto fill-emerald-100" />
                <span
                    class="text-emerald-800 self-center text-sm font-semibold  font-['Lexend_Deca'] whitespace-nowrap flex flex-col rtl:flex-row rtl:space-x-reverse"
                >
                    <span>Ndihpezembo</span>
                    <span class="text-emerald-900 hidden xl:flex">Plataforma de doações para ajuda humanitária</span>
                </span>
            </a>
            <div
                class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse font-['Anta']"
            >

                <button
                    data-collapse-toggle="navbar-sticky"
                    type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
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
                class="items-center justify-between hidden w-full lg:flex lg:w-auto md:order-1"
                id="navbar-sticky"
            >
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-bold font-['Anta'] border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0"
                >
                    <li>
                        <a
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
                            Início</a
                        >
                    </li>
                    <li>
                        <a
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
                        </a>
                    </li>
                    <li>
                        <a
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
                        </a>
                    </li>
                    <li>
                        <a
                            :href="route('web.succeeded.campaigns')"
                            class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"


                            :class="{
                                'text-emerald-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:90%_2px] bg-no-repeat':
                                    route().current('web.succeeded.campaigns'),
                                'text-gray-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:0%_2px] hover:bg-[length:90%_2px] bg-no-repeat hover:duration-500':
                                    !route().current('web.succeeded.campaigns'),
                            }"
                        >
                            Campanhas concluídas
                        </a>
                    </li>
                    <li>
                        <a
                            href=""
                            class="block py-2 px-3 rounded text-gray-900 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:0%_2px] hover:bg-[length:90%_2px] bg-no-repeat hover:duration-500 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                        >
                            Histórias de sucesso
                        </a>
                    </li>
                    <li>
                        <a
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
                        </a>
                    </li>
                    <li v-if="route().current('policy')">
                        <a
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
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
