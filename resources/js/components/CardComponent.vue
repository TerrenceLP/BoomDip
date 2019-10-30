<template>
        <b-card :title="title" :img-src="img" :img-alt="title" class="mb-3 mr-3" style="min-width:22rem;" img-top>
            <b-card-text>
                <img :src="ratingImg" /> - {{ reviewCount }}
            </b-card-text>
            <b-button :href="id" variant="primary">More</b-button>
            <template v-slot:footer>
                <small class="text-muted"><span v-html="logo"></span> - Last updated 3 mins ago</small>
            </template>
        </b-card>
</template>

<script>
    export default {
        props: ['id','img','logo','title','ratingImg','reviewCount'],
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>

<style>
    .card-img-top {
        object-fit: cover;
        height: 215px;
    }
</style>
