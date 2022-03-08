window.$ = window.jQuery = require('jquery');

// LazyLoad - https://github.com/aFarkas/lazysizes
import 'lazysizes'
// import a plugin
import 'lazysizes/plugins/parent-fit/ls.parent-fit'

// GSAP
// import {
//     gsap,
//     ScrollTrigger
// } from "gsap/all";
// import {
//     DrawSVGPlugin
// } from "gsap/DrawSVGPlugin";
// gsap.registerPlugin(ScrollTrigger, DrawSVGPlugin);

// import Swiper bundle with all modules installed
// import Swiper from 'swiper/bundle';

// Theme Functions
const fSmoothScroll = require('./utils/smooth-scroll')
const ExampleModule = require('./components/example')

// Vue Support Function
import {
    createApp,
    defineAsyncComponent
} from 'vue'

const InitVueComponents = () => {
    // Async components
    const SimpleComponent = defineAsyncComponent(() => import("./vue/simple-component"));
    // Static Components
    const StaticComponent = require('./vue/multi-file-component/child-component').default;

    // Init Vue Instance
    const $VueApp = createApp({});
    $VueApp
        // .component("simple-component", SimpleComponent)
        .component("child-component", StaticComponent);
    $VueApp.mount('#vue-space');
}

// Initialise our components on jQuery.ready…
jQuery(function ($) {
    fSmoothScroll()
    InitVueComponents()
    ExampleModule()
})