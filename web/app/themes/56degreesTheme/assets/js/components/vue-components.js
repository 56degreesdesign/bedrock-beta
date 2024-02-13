const vueComponents = async () => {
    const example = document.querySelector(".example") !== null;

    if (!(example)) return;

    const {
        createApp,
        defineAsyncComponent
    } = await import('vue');

    const $VueApp = createApp({});

    if (example) {
        $VueApp.component("display-posts", defineAsyncComponent({
            loader: () => import("../vue/example.vue"),
            delay: 100,
        }));
    }
    
    if (document.getElementById("vue-space"))
        $VueApp.mount('#vue-space');
}

export const init = vueComponents;