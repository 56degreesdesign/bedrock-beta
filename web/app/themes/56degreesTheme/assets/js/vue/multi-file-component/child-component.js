export default {
    name: "child-component",
    template: '#vue-child-component',
    // Be shure to include .php with vue-template on embeding

    data() {
        return {}
    },

    props: {
        items: Array,
    },
}