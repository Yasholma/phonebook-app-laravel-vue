<template>
    <div class="modal" :class="isAddModalOpen ? 'is-active' : ''">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Contact to Phonebook</p>
                <button
                    class="delete"
                    aria-label="close"
                    @click="toggleAddModal"
                ></button>
            </header>
            <section class="modal-card-body">
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input
                            class="input"
                            :class="{ 'is-danger': errors.name }"
                            type="text"
                            placeholder="Enter Name"
                            v-model="user.name"
                        />
                        <span class="icon is-small is-left">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                    </div>
                    <p v-if="errors.name" class="help is-danger">
                        {{ errors.name[0] }}
                    </p>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input
                            class="input"
                            :class="{ 'is-danger': errors.email }"
                            type="email"
                            placeholder="Enter Email Address"
                            v-model="user.email"
                        />
                        <span class="icon is-small is-left">
                            <ion-icon name="mail-outline"></ion-icon>
                        </span>
                    </div>
                    <p v-if="errors.email" class="help is-danger">
                        {{ errors.email[0] }}
                    </p>
                </div>

                <div class="field">
                    <label class="label">Phone</label>
                    <div class="control has-icons-left has-icons-right">
                        <input
                            class="input"
                            :class="{ 'is-danger': errors.phone }"
                            type="text"
                            placeholder="Enter Phone Number"
                            v-model="user.phone"
                        />
                        <span class="icon is-small is-left">
                            <ion-icon name="call-outline"></ion-icon>
                        </span>
                    </div>
                    <p v-if="errors.phone" class="help is-danger">
                        {{ errors.phone[0] }}
                    </p>
                </div>

                <div class="field">
                    <lable class="label">
                        Status
                    </lable>
                    <div class="control">
                        <label class="radio">
                            <input
                                type="radio"
                                name="status"
                                v-model="user.status"
                                value="public"
                            />
                            Public
                        </label>
                        <label class="radio">
                            <input
                                type="radio"
                                name="status"
                                v-model="user.status"
                                value="private"
                            />
                            Private
                        </label>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" @click="saveContact">
                    Save
                </button>
                <button class="button" @click="toggleAddModal">Cancel</button>
            </footer>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddModal",
    data() {
        return {
            user: { name: "", phone: "", email: "", status: "public" },
            errors: {}
        };
    },
    props: ["isAddModalOpen"],
    methods: {
        toggleAddModal() {
            this.$emit("toggleAddModal");
        },
        saveContact() {
            axios
                .post("/phonebook", this.$data.user)
                .then(res => {
                    if (!!res) {
                        this.$emit("toggleAddModal");
                        this.$parent.initContacts.push(res.data);
                        if (res.data.status === "public") {
                            this.$parent.users.push(res.data);
                        }
                        this.$parent.users.sort((a, b) => a.name > b.name);
                        this.user.name = "";
                        this.user.phone = "";
                        this.user.email = "";
                    }
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        }
    }
};
</script>
