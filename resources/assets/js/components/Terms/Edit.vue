<template>

</template>

<script>

import terms from '../../core/term.js'

export default {
    props: ['id'],

    data() {
        return {
            terms: []
        }
    },

    created() {
        this.getTermsAndConditions()
    },

    methods: {
        getTermsAndConditions() {
            terms.find(this.id).then(terms => {
                this.terms = JSON.parse(terms.data).data
            })
        }
    }
}

</script>