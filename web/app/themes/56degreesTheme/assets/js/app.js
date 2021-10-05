// LazyLoad - https://github.com/aFarkas/lazysizes
import 'lazysizes'
// import a plugin
import 'lazysizes/plugins/parent-fit/ls.parent-fit'

// Theme Functions
const fSmoothScroll = require('./utils/smooth-scroll')
const ExampleModule = require('./components/example')

// Vue Support Function
import Vue from 'vue'

const InitVueComponents = () => {
    // Init Vue Partials Components
    Vue.component(
        'pagination',
        require('./vue/partials/pagination').default
    )

    // Init Multi-files Vue Components
    Vue.component(
        'parent-component',
        require('./vue/multi-file-component/parent-component').default
    )

    Vue.component(
        'child-component',
        require('./vue/multi-file-component/child-component').default
    )

    // One-file Vue Components
    Vue.component(
        'simple-component',
        require('./vue/simple-component').default
    )

    // Init Vue Instance
    new Vue({
        el: document.getElementById('vue-space')
    })
}

// Initialise our components on jQuery.ready…
jQuery(function ($) {
    fSmoothScroll()
    InitVueComponents()
    ExampleModule()
})