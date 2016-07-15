<template>
    <div class="rebuttal padded">
        <div class="card">
            <div class="card-header default">Edit Rebuttal</div>
            <div class="card-block">
                <form @submit.prevent="update">
                    <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
                        <label class="col-sm-3 text-xs-right">Name</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.name" class="form-control" :value="rebuttal.name">
                            <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.body != null }">
                        <label class="col-sm-3 text-xs-right">Body</label>
                        <div class="col-sm-7">
                            <textarea v-model="data.body" class="form-control">{{ rebuttal.body }}</textarea>
                            <label class="form-control-label" v-show="errors.body != null">{{ errors.body }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.active != null }">
                        <label class="col-sm-3 text-xs-right">Active</label>
                        <div class="col-sm-7">
                            <select v-model="data.active" class="c-select form-control">
                                <option value="{{ rebuttal.active }}">{{ rebuttal.active == 1 ? 'Yes' : 'No' }}</option>
                            </select>
                            <label class="form-control-label" v-show="errors.active != null">{{ errors.active }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.campaign != null }">
                        <label class="col-sm-3 text-xs-right">Campaign</label>
                        <div class="col-sm-7">
                            <select v-model="data.campaign" class="c-select form-control">
                                <option value="{{ rebuttal.campaign }}">{{ rebuttal.campaignName }}</option>
                            </select>
                            <label class="form-control-label" v-show="errors.campaign != null">{{ errors.campaign }}</label>
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
            <div class="card-header danger">Danger Zone</div>
            <div class="card-block">
                <button class="btn btn-danger full" @click="destroy">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>

const sweetAlert = require('sweetalert')

import rebuttals from '../../core/rebuttal.js'
import campaigns from '../../core/campaign.js'

export default {

    props: ['id'],

    data() {
        return {
            errors: {
                body: null,
                name: null,
                campaign: null,
                active: null
            },
            campaigns: [],
            rebuttals: [],
            rebuttal: [],
            data: {
                name: null,
                campaign: null,
                body: null,
                active: null
            }
        }
    },

    created() {
        this.getAllRebuttals()
        this.getRebuttal()
        this.getCampaigns()
    },

    methods: {
        getAllRebuttals() {
            rebuttals.all().then(rebuttals => {
                this.rebuttals = JSON.parse(rebuttals.data).data
            })
        },

        getRebuttal() {
            rebuttals.find(this.id).then(rebuttal => {
                this.rebuttal = JSON.parse(rebuttal.data).data

                this.data.campaign = this.rebuttal.campaign
                this.data.active = this.rebuttal.active
            })
        },
        
        getCampaigns() {
            campaigns.all().then(campaigns => {
                this.campaigns = JSON.parse(campaigns.data).data
            })
        },

        update() {
            rebuttals.update(this.rebuttal.id, this.data).then(result => {
                const content = JSON.parse(result.body)

                if (Object.keys(content).length > 0) {
                    this.errors = content
                } else {
                    this.errors = {}

                    sweetAlert({
                        type: 'success',
                        title: 'Success',
                        text: 'Congratulations, you have successfully updated this rebuttal! This message will close in 5 seconds.',
                        timer: 5000,
                        confirmButtonColor: '#2c3e50'
                    })
                }
            })
        },

        destroy() {
            rebuttals.delete(this.rebuttal.id).then(result => {
                window.location.href = '/dashboard#rebuttals'
            })
        }
    }
}

</script>