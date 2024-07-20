import "./bootstrap";
import "../css/app.css";
import "flowbite";

import { createApp, h, DefineComponent } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import VueSelect from "vs-vue3-select";
import VueDatePicker from "@vuepic/vue-datepicker";
import "../css/vue-date-picker.css";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import "vs-vue3-select/dist/vs-vue3-select.css";
import PrimeVue from "primevue/config";
import.meta.glob(["../images/**", "../fonts/**"]);
const appName = "Ndihpezembo";
import "@/components/select/select.css";

//fonts,images
import.meta.glob(["../images/**", "../fonts/**"]);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>("./Pages/**/*.vue"),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("v-select", VueSelect)
            .component("QuillEditor", QuillEditor)
            .component("VueDatePicker", VueDatePicker)
            .use(ZiggyVue)
            .use(PrimeVue)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
}).then((r) => {});
