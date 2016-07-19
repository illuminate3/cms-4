<template>
    <form @submit.prevent="save" v-show="section != []">
        <div class="form-group row">
            <label class="col-sm-3 text-xs-right">Name</label>
            <div class="col-sm-7">
                <input type="text" v-model="section.name" class="form-control" maxlength="75">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 text-xs-right">Description</label>
            <div class="col-sm-7">
                <textarea v-model="section.description" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 text-xs-right">Content</label>
            <div class="col-sm-7">
                <textarea v-model="section.content" class="form-control"></textarea>
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
            errors: []
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