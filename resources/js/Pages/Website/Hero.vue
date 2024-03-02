<script setup lang="ts">
import header from "@images/header.png";
</script>

<template>
    <section
        class="relative bg-gradient-to-b to-white from-emerald-50 dark:bg-gray-900"
    >
        <div class="absolute inset-0 bg-black opacity-0"></div>
        <div class="relative px-4 mx-auto max-w-screen-xxl lg:px-32">
            <div
                class="grid max-w-screen-xxl px-4 py-8 mx-auto lg:gap-8 xxl:gap-0 lg:py-16 lg:px-8 lg:grid-cols-12"
            >
                <div
                    class="mr-auto place-self-center lg:col-span-6 tracking-tight p-8"
                >
                    <h2
                        class="max-w-2xl font-['Lexend_Deca'] mb-4 text-2xl font-black tracking-tight leading-none md:text-3xl 2xl:text-5xl first-letter:uppercase aos-init aos-animate text-teal-900"
                        data-aos="fade-down"
                    >
                        — Torne-se parte da comunidade que faz a
                        <div
                            class="bg-gradient-to-r from-teal-600 to-emerald-800 lg:skew-y-3 rounded-md my-4 w-fit lg:rounded-tl-3xl lg:rounded-br-3xl font-['Black_Ravens'] tracking-widest font-light px-3 text-white"
                        >
                            diferença.
                        </div>
                    </h2>
                    <h1
                        class="max-w-2xl mb-4 text-sm font-extrabold tracking-tight leading-none first-letter:uppercase aos-init aos-animate"
                        data-aos="fade-down"
                    ></h1>

                    <p
                        class="max-w-2xl mb-6 font-light lg:mb-8 md:text-lg lg:text-base dark:text-gray-400 text-justify aos-init aos-animate"
                        data-aos="fade-down"
                    >
                        Ajudamos a conectar pessoas e organizações que precisam
                        de ajuda com pessoas que querem ajudar. Junte-se a nós e
                        faça a diferença.
                    </p>
                    <a
                        href="/"
                        class="inline-flex items-center justify-center px-5 py-3 mr-3 text-center rounded-sm bg-gradient-to-r from-teal-600 to-emerald-600 font-black text-white font-['Lexend_Deca'] hover:bg-emerald-400 focus:ring-4 focus:ring-primary-300 aos-init aos-animate"
                        data-aos="fade-down"
                    >
                        Ler mais
                        <svg
                            class="w-4 h-4 ml-2 -mr-1"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </a>
                </div>
                <div class="lg:col-span-6 justify-center hidden lg:flex">
                    <img
                        :src="header"
                        class="w-auto h-auto object-contain"
                        alt="Illustration"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
