<template>
    <div class="column is-4 register-container">
        <h1 class="has-text-centered">Register Here</h1>
        <form v-on:submit.prevent="registerUser">
            <div class="field">
                <p class="control">
                    <input
                        class="input"
                        type="text"
                        placeholder="Name"
                        v-model="name"
                    />
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <input
                        class="input"
                        type="email"
                        placeholder="Email"
                        v-model="email"
                    />
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <input
                        class="input"
                        type="password"
                        placeholder="Password"
                        v-model="password"
                    />
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button type="submit" class="button is-success">
                        Register
                    </button>
                </p>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return { name: "", email: "", password: "" };
    },
    methods: {
        registerUser() {
            axios
                .post("/register", this.$data)
                .then(res => {
                    if (res.status === 201) {
                        this.$root.$data.isAuthenticated = true;
                        this.$root.$data.user = res.data.data;
                        this.$router.push("phonebook");
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss">
.register-container {
    margin: auto;
    h1 {
        font-size: 2rem;
        margin: 1rem 0;
    }
}
</style>
