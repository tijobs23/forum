<template>
    <a href="#" class="ml-2 pl-2 border-l" :class="isActive ? 'font-bold': ''" @click.prevent="subscribe" v-text="isActive ? 'Abonné' : 'S\'abonner'"></a>
</template>

<script>
export default {
    props: ["active"],

    data() {
        return {
            isActive: this.active
        };
    },

    methods: {
        subscribe() {
            axios[this.isActive ? "delete" : "post"](
                location.pathname + "/subscriptions"
            );

            this.isActive = !this.isActive;

            if (this.isActive) {
                flash("D'accord, nous vous avertirons lorsque ce fil de discussion sera mis à jour !");
            }
        }
    }
};
</script>
