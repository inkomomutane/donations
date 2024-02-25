<script setup lang="ts">
import header from "@images/header.png"

window.addEventListener('scroll', function () {

    if(document.getElementById("default-nav") && document.getElementById("default-section")){
        let navbar = document.getElementById("default-nav");
        let section = document.getElementById("default-section");
        let sticky = section?.offsetTop ?? 0;
        if (window.scrollY >= sticky) {
            navbar?.classList.add(
                "fixed", "top-0", "w-full", "z-50", "transition", "duration-500", "ease-in-out","bg-white"

            )
        } else {
            navbar?.classList.remove("fixed", "top-0", "w-full", "z-50", "transition", "duration-500", "ease-in-out","bg-white");
        }
    }
});
</script>

<template>
    <nav id="default-nav" class="bg-emerald-50  w-full dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-2 rtl:space-x-reverse">
              <svg class="w-8 h-8 fill-emerald-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M19.86 8.09c0 .15 0 .3-.01.44-1.53-.57-3.33-.22-4.53.86a4.43 4.43 0 00-2.98-1.14c-2.46 0-4.46 2.01-4.46 4.49 0 2.83 1.42 4.9 2.78 6.24-.11-.01-.2-.03-.28-.06C7.79 18.03 2 14.35 2 8.09 2 5.33 4.22 3.1 6.96 3.1c1.63 0 3.07.78 3.97 1.99A4.957 4.957 0 0114.9 3.1c2.74 0 4.96 2.23 4.96 4.99z" opacity=".4"></path>
                    <path d="M18 9.59c-1.07 0-2.04.52-2.64 1.32-.6-.8-1.56-1.32-2.64-1.32-1.82 0-3.3 1.48-3.3 3.32 0 .71.11 1.36.31 1.96.94 2.97 3.83 4.74 5.26 5.23.2.07.53.07.74 0 1.43-.49 4.32-2.26 5.26-5.23.2-.61.31-1.26.31-1.96 0-1.84-1.48-3.32-3.3-3.32z"></path>
                </svg>
                <span class="text-emerald-800 self-center text-base font-black font-['Lexend_Deca'] whitespace-nowrap ">
                    Nepano
                </span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse font-['Anta']">
                <button type="button" class=" bg-white text-emerald-900

                hover:text-white hover:bg-emerald-600   hover:border-white
                duration-300
                focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded
                border border-emerald-950
                text-sm px-4 py-2 text-center">
                    Faça uma doação
                </button>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>

                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-bold font-['Anta'] border border-gray-100 rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0  ">
                    <li>
                        <a href="#" class="block py-2 px-3 text-white bg-emerald-700
                        md:bg-transparent md:text-emerald-700 !font-black md:p-0 bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:90%_2px] bg-no-repeat   " aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="

                        bg-left-bottom bg-gradient-to-r from-emerald-900 to-gold-emerald-950 bg-[length:0%_2px] hover:bg-[length:90%_2px] bg-no-repeat hover:duration-500
                        block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                            Sobre nós
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                            Causas
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                            Campanhas
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 md:dark:hover:text-emerald-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                            Contatos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section  class="relative bg-gradient-to-b to-white from-emerald-50 dark:bg-gray-900">

        <div class="absolute   inset-0 bg-black opacity-0"></div>
        <div class="relative px-4 mx-auto max-w-screen-xxl  lg:px-32 ">

            <div class="grid max-w-screen-xxl px-4 py-8 mx-auto lg:gap-8 xxl:gap-0 lg:py-16 lg:px-8  lg:grid-cols-12">


                <div class="mr-auto place-self-center lg:col-span-6 tracking-tight p-8">

                    <h2 class="max-w-2xl font-['Lexend_Deca'] mb-4 text-2xl font-black tracking-tight leading-none md:text-3xl 2xl:text-5xl
                      first-letter:uppercase aos-init aos-animate text-teal-900 " data-aos="fade-down">

                        — Torne-se parte da comunidade que faz a
                        <div class=" bg-gradient-to-r from-teal-600 to-emerald-800  lg:skew-y-3 rounded-md  my-4 w-fit lg:rounded-tl-3xl lg:rounded-br-3xl font-['Black_Ravens'] tracking-widest font-light px-3  text-white">diferença.</div>
                    </h2>
                    <h1 class="max-w-2xl mb-4  text-sm font-extrabold tracking-tight leading-none first-letter:uppercase aos-init aos-animate" data-aos="fade-down">

                    </h1>

                    <p class="max-w-2xl mb-6 font-light lg:mb-8 md:text-lg lg:text-base dark:text-gray-400 text-justify aos-init aos-animate" data-aos="fade-down">
                       Ajudamos a conectar pessoas e organizações que precisam de ajuda com pessoas que querem ajudar. Junte-se a nós e faça a diferença.
                    </p>
                    <a href="/"
                       class="inline-flex items-center justify-center px-5 py-3 mr-3 text-center rounded-sm
                       bg-gradient-to-r from-teal-600 to-emerald-600 font-black text-white font-['Lexend_Deca'] hover:bg-emerald-400 focus:ring-4 focus:ring-primary-300 aos-init aos-animate" data-aos="fade-down">
                        Ler mais
                        <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
                <div class="lg:col-span-6  justify-center hidden lg:flex">
                    <img :src="header" class="w-auto h-auto object-contain" alt="Illustration">
                </div>

            </div>
        </div>
    </section>

    <div id="default-section"  class="bg-emerald-950 py-10 block">
        <div class="max-w-screen-2xl mx-auto">
            <div class="grid grid-cols-3 justify-between items-center font-['Lexend_Deca'] ">
                <div class="flex flex-col items-center space-x-2">
                    <h2 class="text-base md:text-4xl text-yellow-200 font-black "><sup>+</sup>23000</h2>
                    <div class="flex text-xs md:text-base text-center text-white font-yellow-100 max-w-[15rem] font-light mt-3">
                        Beneficiários ajudados a partir de campanhas realizadas.
                    </div>
                </div>
                <div class="flex flex-col items-center space-x-2">
                    <h2 class="text-base md:text-4xl text-yellow-200 font-black "><sup>+</sup>10000</h2>
                    <div class="flex text-xs md:text-base text-center text-white font-yellow-100 max-w-[15rem] font-light mt-3">
                        Campanhas realizadas com sucesso.
                    </div>
                </div>
                <div class="flex flex-col items-center space-x-2">
                    <h2 class="text-base md:text-4xl text-yellow-200 font-black "><sup>+</sup>8Milhões </h2>
                    <div class="flex text-xs md:text-base text-center text-white font-yellow-100 max-w-[15rem] font-light mt-3">
                        Arrecadados nas campanhas realizadas.
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
