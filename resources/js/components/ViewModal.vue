<template>
    <div class="modal" :class="isViewModalOpen ? 'is-active' : ''">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ user.name }}'s Profile</p>
                <button
                    class="delete"
                    aria-label="close"
                    @click="toggleViewModal"
                ></button>
            </header>
            <section class="modal-card-body">
                <li class="panel-block">
                    <div class="column is-2"><strong>Name</strong></div>
                    {{ user.name }}
                </li>
                <li class="panel-block">
                    <div class="column is-2"><strong>Email</strong></div>
                    {{ user.email }}
                </li>
                <li class="panel-block">
                    <div class="column is-2"><strong>Phone</strong></div>
                    {{ user.phone }}
                </li>
                <li class="panel-block">
                    <div class="column is-2"><strong>Status</strong></div>
                    {{ user.status }}
                </li>
            </section>
            <footer class="modal-card-foot">
                <button class="button" @click="toggleViewModal">Close</button>
            </footer>
        </div>
    </div>
</template>

<script>
export default {
    name: "ViewModal",
    data() {
        return {
            user: {}
        };
    },
    props: ["isViewModalOpen"],
    methods: {
        toggleViewModal() {
            this.$emit("toggleViewModal");
        }
    }
};
</script>
