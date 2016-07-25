<template>
    <div class="promo create padded">
        <div class="card">
            <div class="card-header default">Create Promo</div>
            <div class="card-block">
                <form @submit.prevent="save">
                    <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
                        <label class="col-sm-3 text-xs-right">Name</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.name" class="form-control">
                            <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.body != null }">
                        <label class="col-sm-3 text-xs-right">Body</label>
                        <div class="col-sm-7">
                            <textarea v-model="data.body" class="form-control"></textarea>
                            <label class="form-control-label" v-show="errors.body != null">{{ errors.body }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.campaign != null }">
                        <label class="col-sm-3 text-xs-right">Campaign</label>
                        <div class="col-sm-7">
                            <select v-model="data.campaign" class="form-control c-select">
                                <option v-for="campaign in campaigns" value="{{ campaign.script }}">{{ campaign.name }}</option>
                            </select>
                            <label class="form-control-label" v-show="errors.campaign != null">{{ errors.campaign }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.active != null }">
                        <label class="col-sm-3 text-xs-right">Active</label>
                        <div class="col-sm-7">
                            <select v-model="data.active" class="form-control c-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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

import promos from '../../core/promo.js'
import campaigns from '../../core/campaign.js'

export default {
    props: ['campaigns'],

    data() {
        return {
            errors: {
                active: null,
                campaign: null,
                name: null,
                body: null
            },
            data: {
                active: null,
                campaign: null,
                name: null,
                body: null
            }
        }
    },

    created() {
        this.campaigns = JSON.parse(this.campaigns)
    },

    methods: {
        save() {
            promos.create(this.data).then(result => {
                const content = JSON.parse(result.body)

                if (Object.keys(content).length > 0) {
                    this.errors = content
                } else {
                    this.errors = {}
                    window.location.href = '/dashboard#promos'
                }
            })
        }
    }
}

</script>