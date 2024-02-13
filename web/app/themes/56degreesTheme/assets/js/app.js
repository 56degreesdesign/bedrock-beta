window.$ = window.jQuery = require('jquery');

// LazyLoad - https://github.com/aFarkas/lazysizes
import 'lazysizes'
// import a plugin
import 'lazysizes/plugins/parent-fit/ls.parent-fit'

// Theme Functions
const fSmoothScroll = require('./utils/smooth-scroll')
import observeAndExecute from './utils/observe-and-execute';
const ExampleModule = require('./components/example')
// const fGsapController = require('./components/gsap-controller')
const fCarousels = require('./components/carousels');


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
    // fGsapController.init()

    observeAndExecute(".swiper", () => {
        fCarousels.init();
    }, true);
})