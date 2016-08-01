<template>
    <div class="row padded">
        <div class="col-sm-9">
            <div class="rebuttals">
                <div class="card primary">
                    <div class="card-header">Rebuttals</div>
                    <div class="card-block">
                        <div class="table-responsive" v-show="rebuttals.length > 0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Rebuttal</th>
                                        <th>Active</th>
                                        <th>Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="rebuttal in rebuttals">
                                        <td><a href="/rebuttals/{{ rebuttal.id }}/edit">{{ rebuttal.name }}</a></td>
                                        <td>
                                            <i v-show="rebuttal.active == 1" class="fa fa-check"></i>
                                            <i v-else class="fa fa-remove"></i>
                                        </td>
                                        <td>{{ rebuttal.updated }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>This campaign does not have any rebuttals yet</div>
                    </div>
                </div>
            </div>

            <div class="promos">
                <div class="card primary">
                    <div class="card-header">Promotions</div>
                    <div class="card-block">
                        <div class="table-responsive" v-show="promos.length > 0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Active</th>
                                        <th>Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="promo in promos">
                                        <td><a href="/promos/{{ promo.id }}/edit">{{ promo.name }}</a></td>
                                        <td>
                                            <i v-show="promo.active == 1" class="fa fa-check"></i>
                                            <i v-else class="fa fa-remove"></i>
                                        </td>
                                        <td>{{ promo.updated }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>This campaign doesn't have any promos.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <a href="/rebuttals/create" class="btn btn-block btn-default">New Rebuttal</a>
            <a href="/promos/create" class="btn btn-block btn-primary">New Promo</a>
            <a href="/tabs/create" class="btn btn-block btn-warning">New Tab</a>
        </div>
    </div>
</template>

<script>

import campaigns from '../core/campaign.js'

export default {

    props: ['script'],

    data() {
        return {
            campaign: [],
            promos: [],
            rebuttals: []
        }
    },

    created() {
        this.getCampaign()
    },

    methods: {
        getCampaign() {
            campaigns.find(this.script).then(campaign => {
                this.campaign = JSON.parse(campaign.data).data
                this.rebuttals = this.campaign.rebuttals.data
                this.promos = this.campaign.promos.data
            })
        }
    }
}

</script>