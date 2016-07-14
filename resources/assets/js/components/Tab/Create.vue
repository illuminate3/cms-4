<template>
    <div class="tab new padded">
        <div class="card">
            <div class="card-header default">New Tab</div>
            <div class="card-block">
                <form @submit.prevent="save">
                    <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
                        <label class="col-sm-3 text-xs-right">Name</label>
                        <div class="col-sm-7">
                            <input type="text" v-model="data.name" class="form-control">
                            <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
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
                    <div class="form-group row" :class="{ 'has-danger': errors.campaign != null }">
                        <label class="col-sm-3 text-xs-right">Campaign</label>
                        <div class="col-sm-7">
                            <select v-model="data.campaign" class="form-control c-select">
                                <option v-for="campaign in campaigns" value="{{ campaign.id }}">{{ campaign.name }}</option>
                            </select>
                            <label class="form-control-label" v-show="errors.campaign != null">{{ errors.campaign }}</label>
                        </div>
                    </div>
                    <div class="form-group row" :class="{ 'has-danger': errors.popup != null }">
                        <label class="col-sm-3 text-xs-right">Popup</label>
                        <div class="col-sm-7">
                            <select v-model="data.popup" class="form-control c-select">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <label class="form-control-label" v-show="errors.popup != null">{{ errors.popup }}</label>
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
import tabs from '../../core/tab.js'

export default {
    data() {
        return {
            data: {
                name: null,
                active: null,
                popup: null,
                campaign: null
            },
            campaigns: [],
            errors: {
                name: null,
                active: null,
                popup: null,
                campaign: null
            }
        }
    },

    created() {
        this.getAllCampaigns()
    },

    methods: {
        save() {
            tabs.create(this.data).then(result => {
                const content = JSON.parse(result.body)

                if (Object.keys(content).length === 0) {
                    window.location.href = '/dashboard#tabs'
                }

                this.errors = content
            })
        },

        getAllCampaigns() {
            campaigns.all().then(campaigns => {
                this.campaigns = JSON.parse(campaigns.data).data
            })
        }
    }
}

</script>