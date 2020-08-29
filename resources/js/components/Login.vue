<template>
    <div class="column is-4 login-container">
        <h1 class="has-text-centered">Login Here</h1>
        <form v-on:submit.prevent="loginUser">
            <div class="field">
                <p class="control has-icons-left has-icons-right">
                    <input
                        class="input"
                        type="email"
                        placeholder="Email"
                        v-model="email"
                    />
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input
                        class="input"
                        type="password"
                        placeholder="Password"
                        v-model="password"
                    />
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button type="submit" class="button is-success">
                        Login
                    </button>
                </p>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return { email: "", password: "" };
    },
    methods: {
        loginUser() {
            axios
                .post("/login", this.$data)
                .then(res => {
                    this.$root.$data.isAuthenticated = true;
                    this.$root.$data.user = res.data.data;
                    this.$router.push("phonebook");
                })
                .catch(err => {
                    console.log(err);
                    alert("Incorrect credentials");
                });
        }
    }
};
</script>

<style lang="scss">
.login-container {
    margin: auto;
    h1 {
        font-size: 2rem;
        margin: 1rem 0;
    }
}
</style>
