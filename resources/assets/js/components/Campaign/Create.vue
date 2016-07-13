<template>
    <div class="campaign create padded">
        <div class="card">
            <div class="card-header default">New Campaign</div>
            <div class="card-block">
                <form @submit.prevent="create">
                    <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
                        <label class="col-sm-3 text-xs-right">Name</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.name" class="form-control" placeholder="The name of your campaign">
                            <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.script != null }">
                        <label class="col-sm-3 text-xs-right">Script</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.script" class="form-control">
                            <label class="form-control-label" v-show="errors.script != null">{{ errors.script }}</label>
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

import campaigns from '../../core/campaign.js'

export default {

    data() {
        return {
            data: {
                active: null,
                script: null,
                name: null
            },
            errors: {
                active: null,
                script: null,
                name: null
            }
        }
    },

    methods: {
        create() {
            campaigns.create(this.data).then(result => {
                const content = JSON.parse(result.body)

                if (Object.keys(content).length > 0) {
                    this.errors = content
                } else {
                    this.errors = {}
                    window.location.href = '/dashboard#campaigns'
                }
            })
        }
    }
}

</script>