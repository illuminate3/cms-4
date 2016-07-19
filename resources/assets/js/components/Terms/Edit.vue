<template>
    <div class="terms edit padded">
        <div class="card">
            <div class="card-header default">Edit Terms</div>
            <div class="card-block">
                <form @submit.prevent="save">
                    <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
                        <label class="col-sm-3 text-xs-right">Name</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.name" value="{{ terms.name }}" class="form-control">
                            <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.active != null }">
                        <label class="col-sm-3 text-xs-right">Active</label>
                        <div class="col-sm-7">
                            <select v-model="data.active" class="form-control c-select">
                                <option value="{{ terms.active }}">{{ terms.active == '1' ? 'Yes' : 'No' }}</option>
                                <option value="{{ terms.active == '1' ? '0' : '1' }}">{{ terms.active == '1' ? 'No' : 'Yes' }}</option>
                            </select>
                            <label class="form-control-label" v-show="errors.active != null">{{ errors.active }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.type != null }">
                        <label class="col-sm-3 text-xs-right">Type</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.type" class="form-control" value="{{ terms.type }}">
                            <label class="form-control-label" v-show="errors.type != null">{{ errors.type }}</label>
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
                            <button class="btn btn-default full">Save</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header default">Terms Sections</div>
            <div class="card-block">
                <div class="terms table-responsive" v-show="terms.sections != undefined && terms.sections.length > 0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Content (50)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="draggable">
                            <tr v-for="section in terms.sections" data-pattern-id="{{ section.id }}">
                                <td>{{ section.id }}</td>
                                <td><a>{{ section.name }}</a></td>
                                <td>{{ section.content.slice(0, 50) }}...</td>
                                <td><a @click="removeSection(section)"><i class="fa fa-remove"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
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
                type: null,
                pattern: null
            },
            errors: {
                name: null,
                active: null,
                description: null,
                type: null,
                pattern: null
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
            })
        },

        save() {
            this.setupPattern()

            terms.update(this.terms.id, this.data).then(result => {
                const content = JSON.parse(result.body)

                if (Object.keys(content).length === 0) {
                    window.location.href = '/dashboard#terms'
                }

                this.errors = content
            })
        },

        removeSection(section) {
            this.terms.sections.$remove(section)
        },

        setupPattern() {
            const sections = document.querySelectorAll('.draggable tr')

            let pattern = ''

            sections.forEach((elements, index, array) => {
                const sectionId = elements.getAttribute('data-pattern-id')

                pattern += sectionId

                if (index != (sections.length - 1)) {
                    pattern += '-'
                }
            })

            this.data.pattern = pattern
        }
    }
}

</script>