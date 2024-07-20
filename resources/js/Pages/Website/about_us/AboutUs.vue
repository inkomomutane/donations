<script setup lang="ts">
import Navbar from "@/Pages/Website/Navbar.vue";
import AboutHero from "./AboutHero.vue";
import Footer from "@/Pages/Website/Footer.vue";

window.addEventListener("scroll", function () {
    if (
        document.getElementById("default-nav") &&
        document.getElementById("default-section")
    ) {
        let navbar = document.getElementById("default-nav");
        let section = document.getElementById("default-section");
        let sticky = section?.offsetTop ?? 0;
        if (window.scrollY >= sticky) {
            navbar?.classList.add(
                "fixed",
                "top-0",
                "w-full",
                "z-50",
                "transition",
                "duration-500",
                "ease-in-out",
                "bg-white",
                "shadow-2xl",
                "shadow-emerald-50",
            );
        } else {
            navbar?.classList.remove(
                "fixed",
                "top-0",
                "w-full",
                "z-50",
                "transition",
                "duration-500",
                "ease-in-out",
                "bg-white",
                "shadow-2xl",
                "shadow-emerald-50",
            );
        }
    }
});
</script>

<template>
    <Navbar className="sticky top-0  z-10" />
    <AboutHero />
    <section
        id="default-section"
        class="bg-gradient-to-b from-emerald-100 to-white md:pt-8"
    >
        <div
            class="max-w-screen-lg mx-auto p-6 lg:p-8 sm:px-4 md:px-8 w-full space-y-8 bg-white"
        >
            <div class="mx-auto p-8">
                <h1
                    class="font-['Lexend_Deca'] mb-4 text-xl font-black tracking-tight leading-none md:text-2xl 2xl:text-3xl first-letter:uppercase aos-init aos-animate text-teal-900"
                >
                    — Sobre o Ndihpezembo
                </h1>
                <p
                    class="tracking-tight space-y-4 text-gray-900 leading-8 mb-4"
                >
                    O Ndihpezembo é uma iniciativa inovadora, liderada pelo governo,
                    que surge como resposta à crescente necessidade de
                    regulamentação e segurança nas doações para campanhas de
                    solidariedade. Desde sua fundação em 2023, na vibrante
                    cidade da Beira, Moçambique, temos trabalhado
                    incansavelmente para garantir que os recursos destinados a
                    auxiliar os mais necessitados sejam gerenciados com
                    transparência e eficácia.
                </p>
                <p
                    class="tracking-tight space-y-4 text-gray-900 leading-8 mb-4"
                >
                    Com o compromisso de estabelecer padrões elevados de
                    integridade e prestação de contas, o Ndihpezembo se destaca como
                    uma plataforma confiável e confiável para todos os doadores.
                    Nossa missão é proporcionar um ambiente seguro e
                    transparente onde cada contribuição faça uma diferença
                    tangível na vida daqueles que precisam de auxílio.
                </p>
            </div>
        </div>
    </section>
    <section
        class="bg-gradient-to-b from-white via-emerald-50/10 to-white md:pt-8"
    >
        <div
            class="max-w-screen-lg mx-auto p-6 lg:p-8 sm:px-4 md:px-8 w-full space-y-8"
        >
            <div class="grid md:grid-cols-2 gap-8 gap-x-6">
                <div
                    class="mx-auto p-8 bg-gradient-to-br from-white to-emerald-50 via-white rounded-br-[9rem]"
                >
                    <h1
                        class="font-['Lexend_Deca'] mb-4 text-xl font-black tracking-tight leading-none md:text-2xl 2xl:text-3xl first-letter:uppercase aos-init aos-animate text-teal-900"
                    >
                        — Missão
                    </h1>
                    <p
                        class="tracking-tight space-y-4 text-gray-900 leading-8 mb-4"
                    >
                        Nosso compromisso é proporcionar um ambiente seguro e
                        confiável para todos os doadores, promovendo a
                        transparência e a responsabilidade na distribuição de
                        recursos destinados a causas sociais. Acreditamos que
                        cada contribuição, por menor que seja, pode fazer uma
                        grande diferença na vida daqueles que mais precisam.
                    </p>
                </div>
                <div
                    class="mx-auto p-8 bg-gradient-to-tl from-white to-emerald-50 via-white rounded-tl-[4rem]"
                >
                    <h1
                        class="font-['Lexend_Deca'] mb-4 text-xl font-black tracking-tight leading-none md:text-2xl 2xl:text-3xl first-letter:uppercase aos-init aos-animate text-teal-900"
                    >
                        — Visão
                    </h1>
                    <p
                        class="tracking-tight space-y-4 text-gray-900 leading-8 mb-4"
                    >
                        Vislumbramos um futuro onde cada pessoa tenha acesso a
                        recursos essenciais para uma vida digna e próspera.
                        Queremos ser reconhecidos como um catalisador de
                        mudanças positivas em nossa comunidade, promovendo o
                        bem-estar e a igualdade para todos os cidadãos.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gradient-to-b from-white to-emerald-50 md:pt-8">
        <div
            class="max-w-screen-lg mx-auto p-6 lg:p-8 sm:px-4 md:px-8 w-full space-y-8"
        >
            <div class="mx-auto p-8">
                <h1
                    class="font-['Lexend_Deca'] mb-4 text-xl font-black tracking-tight leading-none md:text-2xl 2xl:text-3xl first-letter:uppercase aos-init aos-animate text-teal-900"
                >
                    — Compromisso com a Transparência
                </h1>
                <p
                    class="tracking-tight space-y-4 text-gray-900 leading-8 mb-4"
                >
                    No Ndihpezembo, estamos comprometidos com a transparência em
                    todas as nossas operações. Nossa plataforma proporciona aos
                    doadores a garantia de que seus recursos serão utilizados de
                    forma ética e responsável, com prestação de contas total em
                    relação ao destino final das doações.
                </p>
            </div>
        </div>
    </section>
    <Footer />
</template>
