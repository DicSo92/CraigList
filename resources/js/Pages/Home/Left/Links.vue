<template>
    <div>
        <div class="mt-6">
            <div v-for="link in this.links1"
                 class="text-blue-700 text-md text-center hover:underline cursor-pointer">
                {{link.name}}
            </div>
        </div>
        <div class="mt-6">
            <div v-for="link in this.links2"
                 class="text-blue-700 text-md text-center hover:underline cursor-pointer">
                {{link.name}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Links",
        data () {
            return {
                links1: [
                    {
                        name: 'Aide, FAQ, abus, jur.',
                        link: 'https://www.craigslist.org/about/help/?lang=fr&cc=fr'
                    },
                    {
                        name: 'Éviter scams & fraudes',
                        link: 'https://www.craigslist.org/about/scams?lang=fr&cc=fr'
                    },
                    {
                        name: 'Conseils pour votre sécurité',
                        link: 'https://www.craigslist.org/about/safety?lang=fr&cc=fr'
                    },
                    {
                        name: 'Conditions',
                        link: 'https://www.craigslist.org/about/terms.of.use'
                    },
                    {
                        name: 'Confidentialité',
                        link: 'https://www.craigslist.org/about/privacy.policy?lang=fr&cc=fr'
                    },
                    {
                        name: 'État du système',
                        link: 'https://www.craigslist.org/about/help/system-status?lang=fr&cc=fr'
                    },
                ],
                links2: [
                    {
                        name: 'à propos de craigslist',
                        link: 'https://www.craigslist.org/about/?lang=fr&cc=fr'
                    },
                    {
                        name: 'open source craigslist',
                        link: 'https://www.craigslist.org/about/open_source?lang=fr&cc=fr'
                    },
                    {
                        name: 'Blog craigslist',
                        link: 'http://blog.craigslist.org/'
                    },
                    {
                        name: 'Top craigslist',
                        link: 'https://www.craigslist.org/about/best/all/?lang=fr&cc=fr'
                    },
                    {
                        name: '"craigslist joe"',
                        link: 'http://www.craigslistjoe.com/'
                    },
                    {
                        name: 'craig newmark philanthropies',
                        link: 'https://craignewmarkphilanthropies.org/'
                    },
                ]
            }
        }
    }
</script>

<style scoped>

</style>
