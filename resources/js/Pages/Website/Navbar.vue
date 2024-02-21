<script setup lang="ts">

import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="sticky top-0 z-10">
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div
                class="flex flex-wrap justify-between items-center mx-auto max-w-screen-2xl p-4"
            >
                <a
                    href="https://flowbite.com"
                    class="flex items-center space-x-3 rtl:space-x-reverse"
                >
                    <img
                        src="https://flowbite.com/docs/images/logo.svg"
                        class="h-8"
                        alt="Flowbite Logo"
                    />
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
                    >Donations</span
                    >
                </a>
                <div class="flex items-center space-x-6 rtl:space-x-reverse">
                    <a
                        href="tel:5541251234"
                        class="text-sm text-gray-500 dark:text-white hover:underline"
                    >(555) 412-1234</a
                    >
                    <a
                        href="#"
                        class="text-sm text-blue-600 dark:text-blue-500 hover:underline"
                    >Login</a
                    >
                </div>
            </div>
        </nav>
        <nav class="bg-blue-500 dark:bg-gray-700">
            <div class="max-w-screen-2xl px-4 py-3 mx-auto">
                <div class="flex items-center">
                    <ul
                        class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm font-['Roboto']"
                    >
                        <li>
                            <Link
                                href="/"
                                :class="{
                                    'bg-white p-1.5 px-3 rounded-sm font-black    text-gray-900 dark:text-white':
                                        route().current('welcome'),
                                    'hover:underline text-white font-black ':
                                        !route().current('welcome'),
                                }"
                            >Todas causas</Link
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<style scoped>

</style>
