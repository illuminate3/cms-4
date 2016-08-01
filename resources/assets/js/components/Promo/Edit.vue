<template>
    <div class="promo create padded">
        <div class="card primary">
            <div class="card-header">Edit Promo</div>
            <div class="card-block">
                <form @submit.prevent="update">
                    <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
                        <label class="col-sm-3 text-xs-right">Name</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.name" class="form-control" :value="promo.name">
                            <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.body != null }">
                        <label class="col-sm-3 text-xs-right">Body</label>
                        <div class="col-sm-7">
                            <textarea v-model="data.body" class="form-control">{{ promo.body }}</textarea>
                            <label class="form-control-label" v-show="errors.body != null">{{ errors.body }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.campaign != null }">
                        <label class="col-sm-3 text-xs-right">Campaign</label>
                        <div class="col-sm-7">
                            <select v-model="data.campaign" class="form-control c-select">
                                <option value="{{ promo.campaign }}">{{ promo.campaignName }}</option>
                                <option
                                    v-for="campaign in campaigns"
                                    v-show="campaign.script != promo.campaign"
                                    value="{{ campaign.script }}"
                                >{{ campaign.name }}</option>
                            </select>
                            <label class="form-control-label" v-show="errors.campaign != null">{{ errors.campaign }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.active != null }">
                        <label class="col-sm-3 text-xs-right">Active</label>
                        <div class="col-sm-7">
                            <select v-model="data.active" class="form-control c-select">
                                <option value="{{ promo.active }}">{{ promo.active == 1 ? 'Yes' : 'No' }}</option>
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
        <div class="card danger">
            <div class="card-header">Danger Zone</div>
            <div class="card-block">
                <button class="btn btn-danger" @click="destroy">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>

const sweetAlert = require('sweetalert')

import campaigns from '../../core/campaign.js'
import promos from '../../core/promo.js'

export default {

    props: ['id', 'campaigns'],

    data() {
        return {
            errors: {
                name: null,
                body: null,
                campaign: null,
                active: null
            },
            promo: [],
            data: {
                name: null,
                body: null,
                active: null,
                campaign: null
            }
        }
    },

    created() {
        this.getPromo()

        this.campaigns = JSON.parse(this.campaigns)
    },

    methods: {
        getPromo() {
            promos.find(this.id).then(promo => {
                this.promo = JSON.parse(promo.data).data

                this.data.campaign = this.promo.campaign
                this.data.active = this.promo.active
            })
        },

        update() {
            promos.update(this.promo.id, this.data).then(result => {
                const content = JSON.parse(result.body)

                if (Object.keys(content).length > 0) {
                    this.errors = content
                } else {
                    this.errors = {}

                    sweetAlert({
                        type: 'success',
                        title: 'Success',
                        text: 'Congratulations, you have successfully updated this promotion! This message will close in 5 seconds.',
                        timer: 5000,
                        confirmButtonColor: '#2c3e50'
                    })
                }
            })
        },

        destroy() {
            promos.delete(this.promo.id).then(result => {
                window.location.href = '/dashboard#promos'
            })
        }
    }
}

</script>