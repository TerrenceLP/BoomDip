<template>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-nav>
                <b-button size="sm" class="my-2 my-sm-0" type="button" id="sidebarCollapse">
                    <i class="fas fa-bars fa-lg"></i>
                </b-button>
            </b-navbar-nav>
            <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
            <b-navbar-brand href="#">BoomDIP</b-navbar-brand>
        </b-navbar-nav>
        </b-navbar>
</template>

<script>
    export default {
        mounted() {
            console.log('NavBar Component mounted.')
        },
    }
</script>
