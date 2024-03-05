<script setup lang="ts">
import Navbar from "@/Pages/Website/Navbar.vue";
import Footer from "@/Pages/Website/Footer.vue";
import PolicyHero from "@/Pages/Website/Policy/PolicyHero.vue";

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
    <PolicyHero/>
    <section
        id="default-section"
        class="bg-gradient-to-b from-emerald-100 to-white md:pt-8 pb-32"
    >
        <div
            class="max-w-screen-lg mx-auto p-6 lg:p-8 sm:px-4 md:px-8 w-full space-y-8 bg-white"
        >
            <div class="mx-auto p-8">
                <div
                    class="tracking-tight space-y-4 text-gray-900 leading-8 mb-4 prose max-w-full"

                >

                    <h1>Política de Privacidade do Nepano</h1>

                    <p>A sua privacidade é uma prioridade para nós no Nepano. Estamos comprometidos em garantir que todas as informações pessoais que você compartilha conosco sejam tratadas com o máximo respeito e segurança. Esta política de privacidade explica como coletamos, usamos e protegemos as informações que você fornece ao utilizar nosso website e serviços.</p>

                    <h2>1. Coleta de Informações:</h2>
                    <ul>
                        <li>Quando você visita o nosso site ou faz uma doação, não coletamos nenhum dado pessoal dos doadores.</li>
                        <li>No entanto, para melhorar a sua experiência de utilização do site, podemos recolher automaticamente informações não pessoais, tais como dados de navegação, tipo de dispositivo, e outras informações semelhantes.</li>
                    </ul>

                    <h2>2. Uso das Informações:</h2>
                    <ul>
                        <li>As informações não pessoais coletadas são usadas exclusivamente para melhorar o funcionamento do nosso site, otimizar a sua experiência de navegação e realizar análises estatísticas sobre o uso do site.</li>
                        <li>Não utilizamos essas informações para identificar indivíduos específicos ou para qualquer outro fim que não seja melhorar os nossos serviços.</li>
                    </ul>

                    <h2>3. Compartilhamento de Informações:</h2>
                    <ul>
                        <li>Não compartilhamos, vendemos ou alugamos informações pessoais dos doadores a terceiros.</li>
                        <li>As informações não pessoais podem ser compartilhadas com terceiros para fins de análise e melhoria do nosso site, mas esses dados são sempre agregados e anonimizados para proteger a sua privacidade.</li>
                    </ul>

                    <h2>4. Segurança dos Dados:</h2>
                    <ul>
                        <li>Implementamos medidas de segurança físicas, técnicas e administrativas para proteger as informações que recolhemos contra acesso não autorizado, divulgação ou uso indevido.</li>
                        <li>Qualquer informação relacionada a transações financeiras, como o ID da transação com três números ocultos, é protegida com criptografia e medidas adicionais de segurança para garantir a sua confidencialidade.</li>
                    </ul>

                    <h2>5. Cookies e Tecnologias Semelhantes:</h2>
                    <ul>
                        <li>Podemos utilizar cookies e outras tecnologias de rastreamento para melhorar a funcionalidade do nosso site e personalizar a sua experiência de utilização. No entanto, esses cookies não recolhem informações pessoais dos doadores.</li>
                    </ul>

                    <h2>6. Privacidade de Menores:</h2>
                    <ul>
                        <li>Não recolhemos intencionalmente informações de menores de idade. Se tomarmos conhecimento de que um menor forneceu informações pessoais sem consentimento dos pais ou responsáveis, tomaremos medidas para remover essas informações dos nossos registros.</li>
                    </ul>

                    <h2>7. Alterações na Política de Privacidade:</h2>
                    <ul>
                        <li>Reservamo-nos o direito de atualizar esta política de privacidade periodicamente para refletir mudanças nas nossas práticas de privacidade. Recomendamos que visite esta página regularmente para estar ciente de quaisquer alterações.</li>
                    </ul>

                    <p>No Nepano, estamos comprometidos em proteger a sua privacidade e garantir a segurança das suas informações. Se tiver alguma dúvida sobre esta política de privacidade ou sobre como tratamos as suas informações, entre em contato connosco. Obrigado por confiar em nós para as suas doações e por apoiar as nossas iniciativas de solidariedade.</p>


                </div>
                <p
                    class="tracking-tight space-y-4 text-gray-900 leading-8 mb-4"
                >
                    Com o compromisso de estabelecer padrões elevados de
                    integridade e prestação de contas, o Nepano se destaca como
                    uma plataforma confiável e confiável para todos os doadores.
                    Nossa missão é proporcionar um ambiente seguro e
                    transparente onde cada contribuição faça uma diferença
                    tangível na vida daqueles que precisam de auxílio.
                </p>
            </div>
        </div>
    </section>
    <Footer/>
</template>
