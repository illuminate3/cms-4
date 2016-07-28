<template>
    <form @submit.prevent="save" v-show="data != {}">
        <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
            <label class="col-sm-3 text-xs-right">Name</label>
            <div class="col-sm-7">
                <input v-model="data.name" class="form-control">
                <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.content != null }">
            <label class="col-sm-3 text-xs-right">Content</label>
            <div class="col-sm-7">
                <textarea v-model="data.content" class="form-control"></textarea>
                <label class="form-control-label" v-show="errors.content != null">{{ errors.content }}</label>
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
        <div class="form-group row">
            <div class="col-sm-7 col-sm-push-3">
                <button class="btn btn-default">Save</button>
            </div>
        </div>
    </form>
</template>

<script>

import feature from '../../core/feature.js'

export default {
    props: ['id'],

    created() {
        this.findFeature()
    },

    data() {
        return {
            data: {
                active: null,
                name: null,
                content: null
            },
            errors: {
                active: null,
                name: null,
                content: null
            }
        }
    },

    methods: {
        findFeature() {
            feature.find(this.id).then(response => {
                const data = JSON.parse(response.data).data

                this.data.active = data.active
                this.data.name = data.name
                this.data.content = data.content
            })
        },

        save() {
            feature.edit(this.id, this.data).then(response => {
                const result = JSON.parse(response.body)

                if (Object.keys(result).length === 0) {
                    window.location.href = '/dashboard'
                }

                this.errors = result
            })
        }
    }
}

</script>