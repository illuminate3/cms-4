<template>
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar">
                    <div class="header">
                        <img src="http://indonesian-experience.nl/wp-content/uploads/2015/02/puzzle-head.jpg">
                        <h6>{{ name }}</h6>
                    </div>
                    <div class="links">
                        <ul>
                            <li><a href="/dashboard" class="active"><i class="fa fa-home"></i>dashboard</a></li>
                            <li><a href=""><i class="fa fa-user"></i>account</a></li>
                            <li><a href="/logout"><i class="fa fa-sign-out"></i>leave</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 no-padding">
                <div class="navbar">
                    <div class="pull-xs-left">
                        <ul>
                            <li><a href=""><i class="fa fa-bars"></i></a></li>
                            <li>Your Dashboard</li>
                        </ul>
                    </div>
                    <div class="pull-xs-right">
                        <ul>
                            <li><a href=""><i class="fa fa-bell"></i></a></li>
                            <li><a href=""><i class="fa fa-user"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="profile">
                    <div class="user">
                        <img src="http://indonesian-experience.nl/wp-content/uploads/2015/02/puzzle-head.jpg">
                        <div class="name">
                            <h2>{{ name }}</h2>
                            <p>Software Developer</p>
                        </div>
                    </div>
                    <div class="links">
                        <ul>
                            <li><a href="" class="active">Campaigns</a></li>
                            <li><a href="">Rebuttals</a></li>
                            <li><a href="">Promos</a></li>
                            <li><a href="">Scripts</a></li>
                            <li><a href="">Features</a></li>
                        </ul>
                    </div>
                </div>
                <div class="statistics padded flex-container">
                    <div class="statistic flex-item">
                        <span class="number">51</span>
                        <span class="description">Rebuttals</span>
                    </div>
                    <div class="statistic flex-item">
                        <span class="number">55</span>
                        <span class="description">Rebuttals</span>
                    </div>
                    <div class="statistic flex-item">
                        <span class="number">55</span>
                        <span class="description">Rebuttals</span>
                    </div>
                    <div class="statistic flex-item">
                        <span class="number">55</span>
                        <span class="description">Rebuttals</span>
                    </div>
                </div>

                <div class="row padded">
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-header default">Campaigns</div>
                            <div class="card-block">
                                <div class="table-responsive" v-show="campaigns.length > 0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Script</th>
                                                <th>Campaign</th>
                                                <th>Rebuttals</th>
                                                <th>Promos</th>
                                                <th>Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="campaign in campaigns">
                                                <td>{{ campaign.script }}</td>
                                                <td><a href="/campaigns/{{ campaign.id }}">{{ campaign.name }}</a></td>
                                                <td>{{ campaign.rebuttals }}</td>
                                                <td>{{ campaign.promos }}</td>
                                                <td>{{ campaign.timestamp }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div v-else>You currently do not have any campaigns</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-block btn-default">View Script</button>
                        <button class="btn btn-block btn-info">New Campaign</button>
                        <button class="btn btn-block btn-primary">New Rebuttal</button>
                        <button class="btn btn-block btn-warning">New Promo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import main from '../core/main.js'
    
export default {
    props: ['name'],

    data() {
        return {
            campaigns: []
        }
    },
    
    created() {
        this.getAllCampaigns()
    },
    
    methods: {
        getAllCampaigns() {
            main.campaigns().then(campaigns => {
                this.campaigns = JSON.parse(campaigns.data).data
            })
        }
    }
}

</script>