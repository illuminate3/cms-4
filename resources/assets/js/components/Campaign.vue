<template>
    <div class="row padded">
        <div class="col-sm-9">
            <div class="rebuttals">
                <div class="card">
                    <div class="card-header default">Rebuttals</div>
                    <div class="card-block">
                        <div class="table-responsive" v-show="rebuttals.length > 0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Rebuttal</th>
                                        <th>Active</th>
                                        <th>Updated</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="rebuttal in rebuttals">
                                        <td>{{ rebuttal.name }}</td>
                                        <td>
                                            <i v-show="rebuttal.active == 1" class="fa fa-check"></i>
                                            <i v-else class="fa fa-remove"></i>
                                        </td>
                                        <td>{{ rebuttal.updated }}</td>
                                        <td><a href="/rebuttals/{{ rebuttal.id }}/edit"><i class="fa fa-pencil"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>This campaign does not have any rebuttals yet</div>
                    </div>
                </div>
            </div>

            <div class="promos">
                <div class="card">
                    <div class="card-header default">Promotions</div>
                    <div class="card-block">
                        <div class="table-responsive" v-show="promos.length > 0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Active</th>
                                        <th>Updated</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="promo in promos">
                                        <td>{{ promo.name }}</td>
                                        <td>
                                            <i v-show="promo.active == 1" class="fa fa-check"></i>
                                            <i v-else class="fa fa-remove"></i>
                                        </td>
                                        <td>{{ promo.updated }}</td>
                                        <td><a href=""><i class="fa fa-pencil"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>This campaign doesn't have any promos.</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header danger">Danger Zone</div>
                <div class="card-block">
                    <a class="btn btn-danger">Delete Campaign</a>
                    <a class="btn btn-danger">Reset Rebuttals</a>
                    <a class="btn btn-danger">Reset Promos</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <a href="" class="btn btn-block btn-default">View Script</a>
            <a href="/rebuttals/create" class="btn btn-block btn-primary">New Rebuttal</a>
            <a href="/promos/create" class="btn btn-block btn-warning">New Promo</a>
        </div>
    </div>
</template>

<script>

import rebuttals from '../core/rebuttal'
import promos from '../core/promo'

export default {

    props: ['campaign'],

    data() {
        return {
            rebuttals: [],
            promos: []
        }
    },

    created() {
        this.campaign = JSON.parse(this.campaign)

        this.getAllRebuttals()
        this.getAllPromos()
    },

    methods: {
        getAllRebuttals() {
            rebuttals.campaign(this.campaign.id).then(rebuttals => {
                this.rebuttals = JSON.parse(rebuttals.data).data
            })
        },
        getAllPromos() {
            promos.campaign(this.campaign.id).then(promos => {
                this.promos = JSON.parse(promos.data).data
            })
        }
    }
}

</script>