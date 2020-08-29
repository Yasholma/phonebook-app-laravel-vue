<template>
    <div
        class="column 
                is-three-fifths
                is-offset-one-fifth
                is-centered"
    >
        <pb-add-modal
            :isAddModalOpen="isAddModalOpen"
            @toggleAddModal="toggleAddModal"
        ></pb-add-modal>
        <pb-view-modal
            :isViewModalOpen="isViewModalOpen"
            @toggleViewModal="toggleViewModal"
        ></pb-view-modal>
        <pb-edit-modal
            :isEditModalOpen="isEditModalOpen"
            @toggleEditModal="toggleEditModal"
        ></pb-edit-modal>

        <nav class="panel">
            <p class="panel-heading">
                Cybertech Phonebook

                <button
                    class="button is-link add-btn is-outlined"
                    @click="toggleAddModal"
                    v-if="!loading"
                >
                    Add New
                </button>
                <span v-if="loading" class="loading-icon">
                    <ion-icon name="reload-outline"></ion-icon>
                </span>
            </p>
            <div class="panel-block">
                <p class="control has-icons-left">
                    <input
                        class="input"
                        type="text"
                        v-model="searchQuery"
                        placeholder="Search"
                    />
                    <span class="icon is-left">
                        <ion-icon name="search-outline">s</ion-icon>
                    </span>
                </p>
            </div>
            <p class="panel-tabs">
                <a
                    @click="switchTab('public')"
                    :class="{ 'is-active': activeTab == 'public' }"
                    >Public</a
                >
                <a
                    @click="switchTab('private')"
                    :class="{ 'is-active': activeTab == 'private' }"
                    >Private</a
                >
                <a
                    @click="switchTab('all')"
                    :class="{ 'is-active': activeTab == 'all' }"
                    >All</a
                >
            </p>
            <a
                class="panel-block is-active"
                v-for="user in users"
                :key="user.id"
            >
                {{ user.name }}
                <span class="panel-icon">
                    <ion-icon
                        @click="viewContact(user.id)"
                        name="eye-outline"
                        class="has-text-info"
                        >v</ion-icon
                    >
                    <ion-icon
                        @click="editContact(user.id)"
                        name="create-outline"
                        class="has-text-primary"
                        >e</ion-icon
                    >
                    <ion-icon
                        name="trash-outline"
                        class="has-text-danger"
                        @click="deleteContact(user.id)"
                        >d</ion-icon
                    >
                </span>
            </a>
        </nav>
    </div>
</template>
<script>
import AddModal from "./AddModal";
import ViewModal from "./ViewModal";
export default {
    name: "Home",
    data() {
        return {
            users: [],
            initContacts: [],
            isAddModalOpen: false,
            isViewModalOpen: false,
            isEditModalOpen: false,
            loading: false,
            searchQuery: "",
            activeTab: "public"
        };
    },
    components: {
        AddModal,
        ViewModal
    },
    methods: {
        toggleAddModal() {
            this.isAddModalOpen = !this.isAddModalOpen;
        },
        toggleViewModal() {
            this.isViewModalOpen = !this.isViewModalOpen;
        },
        toggleEditModal() {
            this.isEditModalOpen = !this.isEditModalOpen;
        },
        async getContacts() {
            this.loading = true;
            await axios
                .get("/allContacts")
                .then(res => {
                    this.initContacts.push(...res.data);
                    this.loading = false;
                })
                .catch(err => {
                    console.log(err);
                    this.loading = false;
                });
        },
        viewContact(id) {
            this.toggleViewModal();
            const userDetails = this.users.filter(user => user.id === id)[0];
            this.$children[1].user = userDetails;
        },
        editContact(id) {
            this.toggleEditModal();
            const userDetails = this.users.filter(user => user.id === id)[0];
            this.$children[2].user = userDetails;
        },
        deleteContact(id) {
            if (confirm("Are you sure you want to delete this?")) {
                this.loading = !this.loading;
                axios
                    .delete(`/phonebook/${id}`)
                    .then(res => {
                        this.loading = !this.loading;
                        if (!!res) {
                            this.users = this.users.filter(
                                user => user.id !== id
                            );
                        }
                    })
                    .catch(err => {
                        this.loading = !this.loading;
                        console.log(err);
                    });
            }
        },
        switchTab(type) {
            let contacts = [];
            switch (type) {
                case "public":
                    this.activeTab = "public";
                    contacts = this.initContacts.filter(
                        user => user.status === "public"
                    );
                    break;
                case "private":
                    this.activeTab = "private";
                    contacts = this.initContacts.filter(
                        user => user.status === "private"
                    );
                    break;
                case "all":
                    this.activeTab = "all";
                    contacts = this.initContacts;
                    break;
                default:
                    contacts = this.initContacts.filter(
                        user => user.status === "public"
                    );
            }
            this.users.length = 0;
            this.users.push(...contacts);
        }
    },
    watch: {
        searchQuery() {
            if (this.searchQuery.length > 0) {
                this.users = this.users.filter(user => {
                    let userProps = Object.keys(user);
                    return userProps.some(prop => {
                        let val = String(user[prop]);
                        return (
                            val
                                .toLowerCase()
                                .indexOf(this.searchQuery.toLowerCase()) > -1
                        );
                    });
                });
            } else {
                if (this.activeTab == "public") {
                    this.users = this.initContacts.filter(
                        user => user.status === "public"
                    );
                } else if (this.activeTab === "private") {
                    this.users = this.initContacts.filter(
                        user => user.status === "private"
                    );
                } else {
                    this.users = this.initContacts;
                }
            }
        }
    },
    async mounted() {
        if (!this.$root.$data.isAuthenticated) {
            this.$router.push("/");
        }
        await this.getContacts();
        let contacts = this.initContacts.filter(
            user => user.status === "public"
        );
        this.users.push(...contacts);
    }
};
</script>
<style lang="scss" scoped>
.panel-heading,
.panel-block {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.panel-icon {
    min-width: 80px;
    display: flex;
    align-items: center;

    ion-icon {
        width: 1.4rem;
        height: 1.4rem;
        margin: 0 0.2rem;
    }
}

.loading-icon {
    ion-icon {
        animation-name: spin;
        animation-iteration-count: infinite;
        animation-duration: 1s;
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}
</style>
