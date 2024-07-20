<script setup lang="ts">
import ApplicationLogo from "@components/ApplicationLogo.vue";
</script>

<template>
    <div
        class="sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-emerald-950 bottom-0"
    >
        <div class="p-6 lg:p-8 max-w-screen-xl">
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
                            <ApplicationLogo className="w-8 h-auto fill-emerald-100" />
                        </a>
                    </div>
                </div>

                <div
                    class="ms-4 text-center text-sm text-white dark:text-gray-400 sm:text-end sm:ms-0"
                >
                    Copyright ©
                    <strong class="font-black font-['Lexend_Deca']"> Ndihpezembo </strong
                    >
                    | {{ new Date().getFullYear() }}. Todos os direitos
                    reservados.
                </div>
                <div
                    class="ms-4 text-center text-sm text-white dark:text-gray-400 sm:text-end sm:ms-0"
                >
                    <a :href="route('policy')" class="hover:underline">
                        Políticas de privacidade
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
