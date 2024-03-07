<script setup lang="ts">
const appName = import.meta.env.VITE_APP_NAME;
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div
        class="sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-emerald-950  bottom-0"
    >
        <div class="p-6 lg:p-8 max-w-screen-2xl">
            <div
                class="flex justify-center my-8 px-6 gap-x-4 sm:items-center sm:justify-between"
            >
                <div
                    class="text-center text-sm text-white dark:text-gray-400 sm:text-start"
                >
                    <div class="flex items-center gap-4">
                        <a
                            href="https://github.com/sponsors/taylorotwell"
                            class="group inline-flex gap-x-2 items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >
                            <svg
                                class="w-8 h-8 fill-emerald-100"
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
                        </a>
                    </div>
                </div>

                <div
                    class="ms-4 text-center text-sm text-white dark:text-gray-400 sm:text-end sm:ms-0"
                >
                    Copyright ©
                    <strong class="font-black font-['Lexend_Deca']">
                        {{ appName }}</strong
                    >
                    | {{ new Date().getFullYear() }}. Todos os direitos
                    reservados.
                </div>
                <div class="ms-4 text-center text-sm text-white dark:text-gray-400 sm:text-end sm:ms-0">
                    <Link :href="route('policy')" class="hover:underline">
                        Políticas de privacidade
                    </Link>
                </div>
            </div>

        </div>
    </div>
</template>
