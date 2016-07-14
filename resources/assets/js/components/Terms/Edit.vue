<template>
    <div class="terms edit padded">
        <div class="card">
            <div class="card-header default">Edit Terms and Conditions</div>
            <div class="card-block">
                <form @submit.prevent="save">
                    <div class="form-group row" :class="{ 'has-danger': errors.type != null }">
                        <label class="col-sm-3 text-xs-right">Type</label>
                        <div class="col-sm-7">
                            <select v-model="data.type" class="form-control c-select">
                                <option value="{{ terms.typeId }}">{{ terms.type }}</option>
                            </select>
                            <label class="form-control-label" v-show="errors.type != null">{{ errors.type }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.active != null }">
                        <label class="col-sm-3 text-xs-right">Active</label>
                        <div class="col-sm-7">
                            <select v-model="data.active" class="form-control c-select">
                                <option value="{{ terms.active }}">{{ terms.active == 1 ? 'Yes' : 'No' }}</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <label class="form-control-label" v-show="errors.active != null">{{ errors.active }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.description != null }">
                        <label class="col-sm-3 text-xs-right">Description</label>
                        <div class="col-sm-7">
                            <textarea v-model="data.description" class="form-control">{{ terms.description }}</textarea>
                            <label class="form-control-label" v-show="errors.description != null">{{ errors.description }}</label>
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
            <div class="card-header default">Sections</div>
            <div class="card-block">
                <div v-show="sections.length > 0">
                    <ul class="sections"></ul>
                </div>
                <div v-else>No sections have been created yet.</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header default">Toolbar</div>
            <div class="card-block">
                <button class="btn btn-default">Add Section</button>
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
                type: null,
                active: null,
                description: null,
                pattern: null
            },
            sections: [],
            errors: {
                type: null,
                active: null,
                description: null,
                pattern: null
            }
        }
    },

    created() {
        this.getTerms()
        this.getAllSections()
    },

    methods: {
        getTerms() {
            terms.find(this.id).then(terms => {
                this.terms = JSON.parse(terms.data).data

                this.data.type = this.terms.typeId
                this.data.active = this.terms.active
            })
        },
        
        getAllSections() {

        },

        save() {
            terms.update(this.terms.id, this.data).then(result => {
                const content = JSON.parse(result.body)

                if (Object.keys(content).length === 0) {
                    window.location.href = '/dashboard#terms'
                }

                this.errors = content
            })
        }
    }
}

</script>