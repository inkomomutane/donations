<script setup lang="ts">
import ApplicationLogo from "@/components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import logo from "@images/logo.png";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-emerald-700"
    >
        <div>
            <Link href="/">
                <ApplicationLogo
                    :image="logo"
                    class="w-20 h-20 fill-current text-gray-500"
                />
            </Link>
        </div>

        <span class="text-white font-black text-2xl ">Ndihpezembo</span>
        <span class="text-white font-black text-sm ">Plataforma de doações para ajuda humanitária</span>

        <div
            class="w-full sm:max-w-md mt-6 p-8 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
