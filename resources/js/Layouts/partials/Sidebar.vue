<script setup lang="ts">
import { ref } from "vue";
import { useSidebar } from "@/composables/useSidebar";
import { Link } from "@inertiajs/vue3";
import logo from "@images/logo.png";

const { isOpen } = useSidebar();
const activeClass = ref("bg-gray-900  text-gray-100 ");
const inactiveClass = ref(
    "border-gray-900 text-gray-100 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100",
);
</script>

<template>
    <div class="flex">
        <!-- Backdrop -->
        <div
            :class="isOpen ? 'block' : 'hidden'"
            class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"
            @click="isOpen = false"
        />
        <!-- End Backdrop -->

        <div
            :class="
                isOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'
            "
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-slate-800 dark:bg-gray-800 lg:translate-x-0 lg:static lg:inset-0"
        >
            <div class="flex items-start justify-start mt-8 ml-3">
                <Link href="/" class="flex items-center">
                    <img :src="logo" class="w-12" />
                    <span class="text-white text-2xl font-bold mx-2">Donations</span>
                </Link>
            </div>

            <nav class="mt-10">
                <Link
                    class="flex items-center px-4 py-2.5 mx-3 duration-200 rounded-sm"
                    :class="[
                        route().current('dashboard')
                            ? activeClass
                            : inactiveClass,
                    ]"
                    :href="route('dashboard')"
                >
                    <svg class="w-5 h-5" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.0313 7C11.8117 7 8 12.4529 8 18.3333C8 19.9137 8.24643 21.4257 8.67984 22.8627C8.89182 23.5656 9.14855 24.2506 9.44308 24.9169C13.5487 34.2045 25 39.8666 25 39.8666C25 39.8666 27.533 38.5335 30.6436 36.1725C28.6744 34.7809 25.9501 32.4265 24.6363 29.3519C24.4792 28.9843 24.3423 28.6063 24.2292 28.2185C23.9981 27.4257 23.8667 26.5914 23.8667 25.7195C23.8667 22.4752 25.8996 19.4667 28.6833 19.4667C30.6151 19.4667 32.0485 20.8165 32.9333 22.7313C33.8181 20.8166 35.2515 19.4667 37.1833 19.4667C39.0246 19.4667 40.5372 20.7828 41.3505 22.6125C41.7651 21.2422 42 19.8129 42 18.3333C42 12.4538 38.1889 7 32.9687 7C29.3466 7 26.6589 9.44674 25 12.9171C23.341 9.44652 20.6533 7 17.0313 7Z" fill="currentColor"></path>
                        <path d="M40.4556 25.1013C41.0815 25.1099 41.5819 25.6243 41.5733 26.2502C41.5222 29.9615 39.7276 32.4863 37.9844 34.0517C37.1167 34.8309 36.2553 35.3801 35.6099 35.7356C35.2862 35.914 35.0138 36.0452 34.818 36.1335C34.72 36.1777 34.6409 36.2113 34.5839 36.2348C34.5553 36.2465 34.5323 36.2557 34.5151 36.2625L34.4937 36.2708L34.4865 36.2736L34.4825 36.2751C33.8966 36.4954 33.2421 36.1994 33.0218 35.6135C32.8018 35.0287 33.0968 34.3764 33.6806 34.155L33.686 34.1529C33.6926 34.1503 33.7047 34.1455 33.7221 34.1383C33.7569 34.124 33.8125 34.1005 33.886 34.0673C34.0333 34.0009 34.2511 33.8963 34.5163 33.7503C35.0487 33.457 35.7595 33.0032 36.4699 32.3653C37.8826 31.0966 39.2667 29.1313 39.3068 26.219C39.3154 25.5931 39.8298 25.0927 40.4556 25.1013Z" fill="currentColor"></path>
                    </svg>

                    <span class="mx-4 font-bold text-base">Campanhas</span>
                </Link>
                <Link
                    class="flex items-center px-4 py-2.5 mx-3 duration-200 rounded-sm"
                    :class="[
                        route().current('province.index')
                            ? activeClass
                            : inactiveClass,
                    ]"
                    :href="route('province.index')"
                >
                    <svg
                        class="w-5 h-5"
                        width="24"
                        height="24"
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M7 9.01L7.01 8.99889"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M11 9.01L11.01 8.99889"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M7 13.01L7.01 12.9989"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M11 13.01L11.01 12.9989"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M7 17.01L7.01 16.9989"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M11 17.01L11.01 16.9989"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M15 21H3.6C3.26863 21 3 20.7314 3 20.4V5.6C3 5.26863 3.26863 5 3.6 5H9V3.6C9 3.26863 9.26863 3 9.6 3H14.4C14.7314 3 15 3.26863 15 3.6V9M15 21H20.4C20.7314 21 21 20.7314 21 20.4V9.6C21 9.26863 20.7314 9 20.4 9H15M15 21V17M15 9V13M15 13H17M15 13V17M15 17H17"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>

                    <span class="mx-4 font-bold text-base">Províncias</span>
                </Link>
                <Link
                    class="flex items-center px-4 py-2.5 mx-3 duration-200 rounded-sm"
                    :class="[
                        route().current('district.list')
                            ? activeClass
                            : inactiveClass,
                    ]"
                    :href="route('district.list')"
                >
                    <svg width="24" height="24" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path class="fill-current text-gray-100" fill-rule="evenodd" clip-rule="evenodd" d="M8 43C8 42.4477 8.44772 42 9 42H39C39.5523 42 40 42.4477 40 43C40 43.5523 39.5523 44 39 44H9C8.44772 44 8 43.5523 8 43Z"></path><path class="fill-current text-gray-100" fill-rule="evenodd" clip-rule="evenodd" d="M12 22V42H17V22H12ZM11 20C10.4477 20 10 20.4477 10 21V43C10 43.5523 10.4477 44 11 44H18C18.5523 44 19 43.5523 19 43V21C19 20.4477 18.5523 20 18 20H11Z"></path><path class="fill-current text-gray-100" opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M17 4L33 10V24H28C27.4477 24 27 24.4477 27 25V42H17V4ZM20 13H22V15H20V13ZM26 13H24V15H26V13ZM28 13H30V15H28V13ZM22 17H20V19H22V17ZM24 17H26V19H24V17ZM30 17H28V19H30V17ZM20 21H22V23H20V21ZM26 21H24V23H26V21ZM28 21H30V23H28V21ZM22 25H20V27H22V25ZM24 25H26V27H24V25ZM20 29H22V31H20V29ZM26 29H24V31H26V29ZM22 33H20V35H22V33ZM24 33H26V35H24V33ZM20 37H22V39H20V37ZM26 37H24V39H26V37Z"></path><path class="fill-current text-gray-100" fill-rule="evenodd" clip-rule="evenodd" d="M29 26V42H36V26H29ZM28 24C27.4477 24 27 24.4477 27 25V43C27 43.5523 27.4477 44 28 44H37C37.5523 44 38 43.5523 38 43V25C38 24.4477 37.5523 24 37 24H28Z"></path><path class="fill-current text-gray-100" fill-rule="evenodd" clip-rule="evenodd" d="M34 30H31V28H34V30Z"></path><path class="fill-current text-gray-100" fill-rule="evenodd" clip-rule="evenodd" d="M34 34H31V32H34V34Z"></path><path class="fill-current text-gray-100" fill-rule="evenodd" clip-rule="evenodd" d="M34 38H31V36H34V38Z"></path><path class="fill-current text-gray-100" fill-rule="evenodd" clip-rule="evenodd" d="M34 42H31V40H34V42Z"></path><path class="fill-current text-gray-100" fill-rule="evenodd" clip-rule="evenodd" d="M15 13L15 21H13L13 13H15Z"></path></svg>

                    <span class="mx-4 font-bold text-base">Distritos</span>
                </Link>
                <Link
                    class="flex items-center px-4 py-2.5 mx-3 duration-200 rounded-sm"
                    :class="[
                        route().current('cause.index')
                            ? activeClass
                            : inactiveClass,
                    ]"
                    :href="route('cause.index')"
                >
                    <svg
                        class="w-5 h-5"
                        fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                        id="mdi-charity"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M12.75,3.94C13.75,3.22 14.91,2.86 16.22,2.86C16.94,2.86 17.73,3.05 18.59,3.45C19.45,3.84 20.13,4.3 20.63,4.83C21.66,6.11 22.09,7.6 21.94,9.3C21.78,11 21.22,12.33 20.25,13.27L12.66,20.86C12.47,21.05 12.23,21.14 11.95,21.14C11.67,21.14 11.44,21.05 11.25,20.86C11.06,20.67 10.97,20.44 10.97,20.16C10.97,19.88 11.06,19.64 11.25,19.45L15.84,14.86C16.09,14.64 16.09,14.41 15.84,14.16C15.59,13.91 15.36,13.91 15.14,14.16L10.55,18.75C10.36,18.94 10.13,19.03 9.84,19.03C9.56,19.03 9.33,18.94 9.14,18.75C8.95,18.56 8.86,18.33 8.86,18.05C8.86,17.77 8.95,17.53 9.14,17.34L13.73,12.75C14,12.5 14,12.25 13.73,12C13.5,11.75 13.28,11.75 13.03,12L8.44,16.64C8.25,16.83 8,16.92 7.73,16.92C7.45,16.92 7.21,16.83 7,16.64C6.8,16.45 6.7,16.22 6.7,15.94C6.7,15.66 6.81,15.41 7.03,15.19L11.63,10.59C11.88,10.34 11.88,10.11 11.63,9.89C11.38,9.67 11.14,9.67 10.92,9.89L6.28,14.5C6.06,14.7 5.83,14.81 5.58,14.81C5.3,14.81 5.06,14.71 4.88,14.5C4.69,14.3 4.59,14.06 4.59,13.78C4.59,13.5 4.69,13.27 4.88,13.08C7.94,10 9.83,8.14 10.55,7.45L14.11,10.97C14.5,11.34 14.95,11.53 15.5,11.53C16.2,11.53 16.75,11.25 17.16,10.69C17.44,10.28 17.54,9.83 17.46,9.33C17.38,8.83 17.17,8.41 16.83,8.06L12.75,3.94M14.81,10.27L10.55,6L3.47,13.08C2.63,12.23 2.15,10.93 2.04,9.16C1.93,7.4 2.41,5.87 3.47,4.59C4.66,3.41 6.08,2.81 7.73,2.81C9.39,2.81 10.8,3.41 11.95,4.59L16.22,8.86C16.41,9.05 16.5,9.28 16.5,9.56C16.5,9.84 16.41,10.08 16.22,10.27C16.03,10.45 15.8,10.55 15.5,10.55C15.23,10.55 15,10.45 14.81,10.27V10.27Z"
                        ></path>
                    </svg>

                    <span class="mx-4 font-bold text-base">Causas</span>
                </Link>
            </nav>
        </div>
    </div>
</template>
