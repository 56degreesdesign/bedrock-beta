window.$ = window.jQuery = require('jquery');

// LazyLoad - https://github.com/aFarkas/lazysizes
import 'lazysizes'
// import a plugin
import 'lazysizes/plugins/parent-fit/ls.parent-fit'

// Theme Functions
const fSmoothScroll = require('./utils/smooth-scroll')
import observeAndExecute from './utils/observe-and-execute';
const ExampleModule = require('./components/example')
const fCarousels = require('./components/carousels');
// const fSelect = require('./components/select');
// const fGsapController = require('./components/gsap-controller')
// const fVueComponents = require('./components/vue-components');

// Initialise our components on jQuery.ready…
jQuery(function ($) {
    fSmoothScroll()
    // fVueComponents.init()
    // fSelect.init()
    ExampleModule()
    // fGsapController.init()

    observeAndExecute(".swiper", () => {
        fCarousels.init();
    }, true);
})