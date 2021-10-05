export default {
    name: "parent-component",
    // Be shure to use <div> with 'inline-template' and is='parent-component' directive
    data() {
        return {
            isLoading: true,
        }
    },

    props: {
        json: Object,
    },
}