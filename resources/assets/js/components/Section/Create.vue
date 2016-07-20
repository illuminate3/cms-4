<template>
    <form @submit.prevent="save">
        <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
            <label class="col-sm-3 text-xs-right">Name</label>
            <div class="col-sm-7">
                <input type="text" v-model="data.name" class="form-control">
                <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.description != null }">
            <label class="col-sm-3 text-xs-right">Description</label>
            <div class="col-sm-7">
                <textarea v-model="data.description" class="form-control"></textarea>
                <label class="form-control-label" v-show="errors.description != null">{{ errors.description }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.content != null }">
            <label class="col-sm-3 text-xs-right">Content</label>
            <div class="col-sm-7">
                <textarea v-model="data.content" class="form-control"></textarea>
                <label class="form-control-label" v-show="errors.content != null">{{ errors.content }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-7 col-sm-offset-3">
                <button class="btn btn-default">Save</button>
            </div>
        </div>
    </form>
</template>

<script>

import section from '../../core/section.js'

export default {
    data() {
        return {
            data: {
                name: null,
                description: null,
                content: null
            },
            errors: {
                name: null,
                description: null,
                content: null
            }
        }
    },

    methods: {
        save() {
            section.create(this.data).then(response => {
                const result = JSON.parse(response.body)

                if (Object.keys(result).length === 0) {
                    window.location.href = '/dashboard#terms'
                }

                this.errors = result
            })
        }
    }
}

</script>