<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://yhyportfolio.netlify.app">
                Cybertech
            </a>

            <a
                role="button"
                class="navbar-burger burger"
                aria-label="menu"
                aria-expanded="false"
                data-target="navbarBasicExample"
            >
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <router-link class="navbar-item" to="/phonebook"
                    >Home</router-link
                >
                <router-link class="navbar-item" to="/about">About</router-link>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div
                        class="buttons"
                        v-if="!this.$root.$data.isAuthenticated"
                    >
                        <router-link to="/register" class="button is-primary">
                            <strong>Sign up</strong>
                        </router-link>
                        <router-link to="/" class="button is-light">
                            Log in
                        </router-link>
                    </div>
                    <a v-else class="nav-item"
                        >Welcome, {{ this.$root.$data.user.name }}</a
                    >
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Header"
};
</script>
