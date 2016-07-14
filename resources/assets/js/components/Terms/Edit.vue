<template>
    <div class="terms edit padded">
        <div class="card">
            <div class="card-header default">Edit Terms</div>
            <div class="card-block">
                <form @submit.prevent="save">
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Name</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.name" value="{{ terms.name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Active</label>
                        <div class="col-sm-7">
                            <select v-model="data.active" class="form-control c-select">
                                <option value="{{ terms.active }}">{{ terms.active == '1' ? 'Yes' : 'No' }}</option>
                                <option value="{{ terms.active == '1' ? '0' : '1' }}">{{ terms.active == '1' ? 'No' : 'Yes' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Type</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.type" class="form-control" value="{{ terms.type }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button class="btn btn-default">Save</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header default">Terms Sections</div>
            <div class="card-block">
                <div class="terms sections" v-show="terms.sections.length > 0">
                    <div v-for="section in terms.sections" class="section">
                        <h5>{{ section.name }}</h5>
                        <p>{{ section.content }}</p>
                    </div>
                </div>
                <div v-else>You currently haven't added any sections.</div>
            </div>
        </div>
    </div>
</template>

<script>

import terms from '../../core/term.js'

export default {
    props: ['id'],

    data() {
        return {
            terms: [],
            data: {
                name: null,
                active: null,
                description: null,
                type: null
            }
        }
    },

    created() {
        this.getTermsAndConditions()
    },

    methods: {
        getTermsAndConditions() {
            terms.find(this.id).then(terms => {
                this.terms = JSON.parse(terms.data).data

                this.data.active = this.terms.active
                console.log(this.terms)
            })
        },

        save() {

        }
    }
}

</script>