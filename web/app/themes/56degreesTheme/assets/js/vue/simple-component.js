export default {
    name: "simple-component",
    template: '#vue-simple-component',
    // Be shure to include .php with vue-template on embeding

    data() {
        return {}
    },

    props: {
        items: Array,
    },
}