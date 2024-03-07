<script setup lang="ts">
import Navbar from "@/Pages/Website/Navbar.vue";
import Footer from "@/Pages/Website/Footer.vue";
import ContactHero from "@/Pages/Website/contact/ContactHero.vue";

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
    <ContactHero />

    <section
        id="default-section"
        class="text-gray-600 body-font relative bg-gradient-to-b from-emerald-100 via-white to-emerald-100 pb-32"
    >
        <form action="https://fabform.io/f/{form-id}" method="post">
            <div
                class="container px-5 pb-24 mx-auto flex sm:flex-nowrap flex-wrap"
            >
                <div
                    class="lg:w-2/3 md:w-1/2 bg-gray-900 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative"
                >
                    <iframe
                        width="100%"
                        height="100%"
                        class="absolute inset-0"
                        frameborder="0"
                        title="map"
                        marginheight="0"
                        marginwidth="0"
                        scrolling="no"
                        src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1084.896700715089!2d34.86133126961533!3d-19.83333999884584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTnCsDUwJzAwLjAiUyAzNMKwNTEnNDMuMSJF!5e1!3m2!1sen!2smz!4v1709659956676!5m2!1sen!2smz"
                        style="filter: grayscale(0) contrast(1.2) opacity(0.4)"
                    ></iframe>
                    <div
                        class="bg-white relative flex flex-wrap py-6 rounded shadow-md"
                    >
                        <div class="lg:w-1/2 px-6">
                            <h2
                                class="title-font font-semibold text-gray-900 tracking-widest text-xs"
                            >
                                Endereço
                            </h2>
                            <p class="mt-1">
                                Bairro de Matacuane, Rua 123, Cidade da beira,
                                Moçambique
                            </p>
                        </div>
                        <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                            <h2
                                class="title-font font-semibold text-gray-900 tracking-widest text-xs"
                            >
                                EMAIL
                            </h2>
                            <a class="text-emerald-500 leading-relaxed"
                                >social@nepano.gov.mz</a
                            >
                            <h2
                                class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4"
                            >
                                Telefone
                            </h2>
                            <p class="leading-relaxed">87 56 16 011</p>
                        </div>
                    </div>
                </div>
                <div
                    class="lg:w-1/3 md:w-1/2 flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0"
                >
                    <h2
                        class="text-gray-900 text-lg mb-1 font-medium title-font"
                    >
                        Feedback
                    </h2>
                    <p class="leading-relaxed mb-5 text-gray-600">
                        Toda a informação que nos enviar será tratada com a
                        máxima confidencialidade.
                    </p>
                    <div class="relative mb-4">
                        <label
                            for="name"
                            class="leading-7 text-sm text-gray-600"
                            >Nome</label
                        >
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="w-full bg-white rounded border border-gray-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        />
                    </div>
                    <div class="relative mb-4">
                        <label
                            for="email"
                            class="leading-7 text-sm text-gray-600"
                            >Email</label
                        >
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full bg-white rounded border border-gray-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        />
                    </div>
                    <div class="relative mb-4">
                        <label
                            for="message"
                            class="leading-7 text-sm text-gray-600"
                            >Mensagem</label
                        >
                        <textarea
                            id="message"
                            name="message"
                            class="w-full bg-white rounded border border-gray-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                        ></textarea>
                    </div>
                    <button
                        class="text-white bg-emerald-500 border-0 py-2 px-6 focus:outline-none hover:bg-emerald-600 rounded text-lg"
                    >
                        Enviar
                    </button>
                </div>
            </div>
        </form>
    </section>

    <Footer />
</template>
