<script setup lang="ts"></script>

<template>
    <article
        class="!w-full rounded-3xl rounded-b-xl bg-emerald-100 dark:bg-gray-700 dark:border-gray-700 transition-transform duration-300 transform-gpu hover:scale-105 hover:shadow-none hover:shadow-gray-400"
    >
        <div>
            <header class="rounded-t-xl">
                <img
                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                    src="https://placehold.co/600x400/6ebb96/ffffff"
                    alt=""
                />
            </header>
        </div>

        <div
            class="w-full p-4 pb-5 text-emerald-950 grid justify-items-stretch col-span-3"
        >
            <div class="flex justify-between">
                <h1
                    class="text-lg font-['Lexend_Deca'] font-semibold line-clamp-1 py-1 first-letter:uppercase bg-emerald-100 dark:bg-gray-700 rounded-sm"
                ></h1>
            </div>
            <div
                class="w-full bg-emerald-100 rounded-full h-2.5 mb-2 dark:bg-gray-700 inline-flex items-center"
            >
                <div
                    class="bg-green-600 h-2.5 rounded-full rounded-r-none dark:bg-green-500"
                    style="width: 50%"
                ></div>

                <div class="rounded-full p-2 w-1 -ml-1 bg-green-300"></div>
            </div>
            <div class="grid grid-cols-2 gap-2 my-2">
                <div>
                    <div
                        class="flex items-center justify-start text-center font-['Roboto'] font-medium rounded-sm gap-x-1"
                    >
                        <strong class="font-black text-green-500"
                            >&nbsp
                        </strong>
                        <span class="text-lg bg-emerald-900"> </span>
                    </div>
                    <div
                        class="flex items-center justify-start text-center font-['Roboto'] font-medium rounded-sm gap-x-1"
                    >
                        <strong class="font-black text-red-500"> </strong>
                        <span class="text-lg"> </span>
                    </div>
                </div>
                <div
                    class="flex items-center justify-end font-bold font-['Lexend_Deca'] text-emerald-900 text-3xl pr-4"
                ></div>
            </div>
            <div
                class="mt-2 p-1.5 h-12 bg-emerald-800/50 hover:bg-emerald-700 text-white text-sm rounded inline-flex items-center font-['Lexend_Deca'] justify-center gap-x-2 font-black"
            ></div>
        </div>
    </article>
</template>
