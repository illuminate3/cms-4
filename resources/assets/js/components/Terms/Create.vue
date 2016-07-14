<template>
    <div class="terms new padded">
        <div class="card">
            <div class="card-header default">New Terms and Conditions</div>
            <div class="card-block">
                <form @submit.prevent="save">
                    <div class="form-group row" :class="{ 'has-danger': errors.type != null }">
                        <label class="col-sm-3 text-xs-right">Type</label>
                        <div class="col-sm-7">
                            <select v-model="data.type" class="form-control c-select">
                                <option v-for="type in types" value="{{ type.id }}">{{ type.type }}</option>
                            </select>
                            <label class="form-control-label" v-show="errors.type != null">{{ errors.type }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.active != null }">
                        <label class="col-sm-3 text-xs-right">Active</label>
                        <div class="col-sm-7">
                            <select v-model="data.active" class="form-control c-select">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <label class="form-control-label" v-show="errors.active != null">{{ errors.active }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.description != null }">
                        <label class="col-sm-3 text-xs-right">Description</label>
                        <div class="col-sm-7">
                            <textarea v-model="data.description" class="form-control"></textarea>
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
    </div>
</template>

<script>

import terms from '../../core/term.js'

export default {
    data() {
        return {
            data: {
                description: null,
                active: null,
                type: null
            },
            types: [],
            errors: {
                type: null,
                active: null,
                description: null
            }
        }
    },

    created() {
        this.getAllTypes()
    },

    methods: {
        save() {
            terms.create(this.data).then(result => {
                const content = JSON.parse(result.body)

                if (Object.keys(content).length == 0) {
                    window.location.href = '/dashboard#terms'
                }
                    
                this.errors = content
            })
        },

        getAllTypes() {
            terms.types().then(types => {
                this.types = JSON.parse(types.body)
            })
        }
    }
}

</script>