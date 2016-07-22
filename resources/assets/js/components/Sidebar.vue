<template>
    <div class="sidebar" id="sidebar">
        <div class="header">
            <img src="/images/flaticons/man.png">
            <h6>{{ name }}</h6>
        </div>
        <div class="links">
            <ul>
                <li><a href="/dashboard" :class="{ 'active': active == 'dashboard' }">Dashboard</a></li>
                
                <li>
                    <a @click="toggle('campaigns')" :class="{ 'active': active == 'campaigns' }">Campaigns</a>
                    <ul class="campaigns slidedown">
                        <li><a href="/campaigns">All Campaigns</a></li>
                        <li><a href="/campaigns/create">New Campaign</a></li>
                    </ul>
                </li>

                <li>
                    <a @click="toggle('rebuttals')" :class="{ 'active': active == 'rebuttals' }">Rebuttals</a>
                    <ul class="rebuttals slidedown">
                        <li><a href="/promos">All Rebuttals</a></li>
                        <li><a href="/promos/create">New Rebuttal</a></li>
                    </ul>
                </li>

                <li>
                    <a @click="toggle('promos')" :class="{ 'active': active == 'promos' }">Promos</a>
                    <ul class="promos slidedown">
                        <li><a href="/promos">All Promos</a></li>
                        <li><a href="/promos/create">New Promo</a></li>
                    </ul>
                </li>

                <li>
                    <a @click="toggle('terms')" :class="{ 'active': active == 'terms' }">Terms</a>
                    <ul class="terms slidedown">
                        <li><a href="/terms/create">New Terms</a></li>
                        <li><a href="/terms">All Terms</a></li>
                        <li><a href="/sections/create">New Section</a></li>
                        <li><a href="/sections">All Sections</a></li>
                    </ul>
                </li>

                <li><a href="/logout">Leave</a></li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    props: ['name'],

    data() {
        return {
            active: null
        }
    },

    methods: {
        toggle(active) {
            $('.slidedown').slideUp(200);
            
            if (active != this.active) {
                const sliders = document.querySelectorAll('.slidedown')

                sliders.forEach((array, index, element) => {
                    const current = sliders[index]
                    current.style.display = 'none'
                })

                $('.' + active + '.slidedown').slideDown(200)
            }

            this.active = active
        }
    }
}

</script>