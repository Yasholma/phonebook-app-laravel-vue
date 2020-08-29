<template>
    <div class="modal" :class="isEditModalOpen ? 'is-active' : ''">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Edit Contact</p>
                <button
                    class="delete"
                    aria-label="close"
                    @click="toggleEditModal"
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
            </section>
            <footer class="modal-card-foot">
                <button
                    class="button is-success"
                    @click="updateContact(user.id)"
                >
                    Update
                </button>
                <button class="button" @click="toggleEditModal">Cancel</button>
            </footer>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditModal",
    data() {
        return {
            user: {},
            errors: {}
        };
    },
    props: ["isEditModalOpen"],
    methods: {
        toggleEditModal() {
            this.$emit("toggleEditModal");
        },
        updateContact(id) {
            axios
                .put(`/phonebook/${id}`, this.$data.user)
                .then(res => {
                    console.log(res);
                    if (!!res) {
                        this.$emit("toggleEditModal");
                    }
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        }
    }
};
</script>
