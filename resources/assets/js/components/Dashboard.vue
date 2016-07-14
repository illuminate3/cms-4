<template>
    <div class="profile">
        <div class="user">
            <img src="http://indonesian-experience.nl/wp-content/uploads/2015/02/puzzle-head.jpg">
            <div class="name">
                <h2>{{ user.name }}</h2>
                <p>{{ user.biography }}</p>
            </div>
        </div>
        <div class="links">
            <ul>
                <li><a @click="navigate('campaigns')" :class="{ 'active': section == 'campaigns' }">Campaigns</a></li>
                <li><a @click="navigate('rebuttals')" :class="{ 'active': section == 'rebuttals' }">Rebuttals</a></li>
                <li><a @click="navigate('promos')" :class="{ 'active': section == 'promos' }">Promos</a></li>
                <li><a @click="navigate('terms')" :class="{ 'active': section == 'terms' }">Terms</a></li>
            </ul>
        </div>
    </div>
    <div class="statistics padded flex-container">
        <div class="statistic flex-item">
            <span class="number">{{ rebuttals.length }}</span>
            <span class="description">Rebuttals</span>
        </div>
        <div class="statistic flex-item">
            <span class="number">{{ campaigns.length }}</span>
            <span class="description">Campaigns</span>
        </div>
        <div class="statistic flex-item">
            <span class="number">{{ promos.length }}</span>
            <span class="description">Promotions</span>
        </div>
        <div class="statistic flex-item">
            <span class="number">{{ terms.length }}</span>
            <span class="description">Terms</span>
        </div>
    </div>

    <div class="row padded">
        <div class="col-sm-9">
            <div class="card" v-show="section == 'campaigns'">
                <div class="card-header default">Campaigns</div>
                <div class="card-block">
                    <div class="table-responsive" v-show="campaigns.length > 0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Campaign</th>
                                    <th>Rebuttals</th>
                                    <th>Promos</th>
                                    <th>Tabs</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="campaign in campaigns">
                                    <td><a href="/campaigns/dashboard/{{ campaign.id }}">{{ campaign.name }}</a></td>
                                    <td>{{ campaign.rebuttals.data.length }}</td>
                                    <td>{{ campaign.promos.data.length }}</td>
                                    <td>{{ campaign.tabs.data.length }}</td>
                                    <td>{{ campaign.timestamp }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else>You currently do not have any campaigns.</div>
                </div>
            </div>
            <div class="card" v-show="section == 'rebuttals'">
                <div class="card-header default">Rebuttals</div>
                <div class="card-block">
                    <div class="table-responsive" v-show="rebuttals.length > 0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Campaign</th>
                                    <th>Active</th>
                                    <th>Rebuttal</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="rebuttal in rebuttals">
                                    <td>{{ rebuttal.campaignName }}</td>
                                    <td>{{ rebuttal.active }}</td>
                                    <td><a href="/rebuttals/{{ rebuttal.id }}/edit">{{ rebuttal.name }}</a></td>
                                    <td>{{ rebuttal.updated }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else>You currenly do not have any rebuttals.</div>
                </div>
            </div>
            <div class="card" v-show="section == 'promos'">
                <div class="card-header default">Promos</div>
                <div class="card-block">
                    <div class="table-responsive" v-show="promos.length > 0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Campaign</th>
                                    <th>Active</th>
                                    <th>Promo</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="promo in promos">
                                    <td>{{ promo.campaignName }}</td>
                                    <td>{{ promo.active }}</td>
                                    <td><a href="/promos/{{ promo.id }}/edit">{{ promo.name }}</a></td>
                                    <td>{{ promo.updated }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else>You currently do not have any promotions.</div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <a href="/campaigns/create" class="btn btn-block btn-default">New Campaign</a>
            <a href="/rebuttals/create" class="btn btn-block btn-primary">New Rebuttal</a>
            <a href="/promos/create" class="btn btn-block btn-warning">New Promo</a>
        </div>
    </div>
</template>

<script>

import campaigns from '../core/campaign.js'
import rebuttals from '../core/rebuttal.js'
import promos from '../core/promo.js'
    
export default {
    props: ['user'],

    data() {
        return {
            campaigns: [],
            rebuttals: [],
            promos: [],
            section: 'campaigns'
        }
    },
    
    created() {
        this.getAllCampaigns()
        this.getAllRebuttals()
        this.getAllPromos()

        let hash = window.location.hash.length > 0 ? window.location.hash : 'campaigns'
        this.section = hash.replace('#', '')

        this.user = JSON.parse(this.user)
    },
    
    methods: {
        getAllCampaigns() {
            campaigns.all().then(campaigns => {
                this.campaigns = JSON.parse(campaigns.data).data
            })
        },
        
        getAllRebuttals() {
            rebuttals.all().then(rebuttals => {
                this.rebuttals = JSON.parse(rebuttals.data).data
            })
        },
        
        getAllPromos() {
            promos.all().then(promos => {
                this.promos = JSON.parse(promos.data).data
            })
        },

        navigate(section) {
            this.section = section
            window.location.hash = section
        }
    }
}

</script>