<template>
    <form @submit.prevent="save" v-show="section != []">
        <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
            <label class="col-sm-3 text-xs-right">Name</label>
            <div class="col-sm-7">
                <input type="text" v-model="section.name" class="form-control" maxlength="75">
                <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.description != null }">
            <label class="col-sm-3 text-xs-right">Description</label>
            <div class="col-sm-7">
                <textarea v-model="section.description" class="form-control"></textarea>
                <label class="form-control-label" v-show="errors.description != null">{{ errors.description }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.content != null }">
            <label class="col-sm-3 text-xs-right">Content</label>
            <div class="col-sm-7">
                <textarea v-model="section.content" class="form-control"></textarea>
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
    props: ['id'],

    data() {
        return {
            section: [],
            errors: {
                name: null,
                description: null,
                content: null
            }
        }
    },

    created() {
        this.getSectionById()
    },

    methods: {
        getSectionById() {
            section.find(this.id).then(section => {
                this.section = JSON.parse(section.data).data
            })
        },

        save() {
            section.update(this.id, this.section).then(result => {
                const content = JSON.parse(result.body)
                console.log(content)

                if (Object.keys(content).length === 0) {
                    window.location.href = '/dashboard#terms'
                }

                this.errors = content
            })
        }
    }
}

</script>