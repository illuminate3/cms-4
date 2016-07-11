<template>
    <div class="rebuttals padded">
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="rebuttal in rebuttals">
                                <td>{{ rebuttal.name }}</td>
                                <td>{{ rebuttal.active }}</td>
                                <td>{{ rebuttal.updated }}</td>
                                <td><a href=""><i class="fa fa-pencil"></i></a></td>
                                <td><a href=""><i class="fa fa-remove"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>This campaign does not have any rebuttals yet</div>
            </div>
        </div>
    </div>
</template>

<script>

import rebuttals from '../core/rebuttal'

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
    },

    methods: {
        getAllRebuttals() {
            rebuttals.all(this.campaign.id).then(rebuttals => {
                this.rebuttals = JSON.parse(rebuttals.data).data
            })
        }
    }

}

</script>