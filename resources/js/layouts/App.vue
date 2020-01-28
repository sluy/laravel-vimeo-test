<template>
    <div>
        <nav-bar></nav-bar>

        <h1>Vue Router Demo App</h1>

        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'about' }">About</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import NavBar from "../components/NavBar";
export default {
    components: { NavBar },
    mounted() {}
};
</script>
