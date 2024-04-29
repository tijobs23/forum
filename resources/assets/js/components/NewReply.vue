<template>
    <div class="py-6 ml-10">
        <div v-if="! signedIn">
            <p class="text-center text-sm text-grey-dark">
                Please <a href="/login" @click.prevent="$modal.show('login')" class="text-blue link">se connecter</a> pour participer dans
                cette discussion.
            </p>
        </div>

        <div v-else-if="! confirmed">
            Pour participer à ce fil de discussion, veuillez vérifier votre e-mail et confirmer votre compte.
        </div>

        <div v-else>
            <div class="mb-3">
                <wysiwyg name="body" v-model="body" placeholder="Quelque chose à dire?"></wysiwyg>
            </div>

            <button type="submit"
                    class="btn is-green"
                    @click="addReply">Poster</button>
        </div>
    </div>
</template>

<script>
import "jquery.caret";
import "at.js";

export default {
    data() {
        return {
            body: ""
        };
    },

    computed: {
        confirmed() {
            return window.App.user.confirmed;
        }
    },

    mounted() {
        $("#body").atwho({
            at: "@",
            delay: 750,
            callbacks: {
                remoteFilter: function(query, callback) {
                    $.getJSON("/api/users", { name: query }, function(
                        usernames
                    ) {
                        callback(usernames);
                    });
                }
            }
        });
    },

    methods: {
        addReply() {
            axios
                .post(location.pathname + "/replies", { body: this.body })
                .catch(error => {
                    flash(error.response.data, "danger");
                })
                .then(({ data }) => {
                    this.body = "";

                    flash("Your reply has been posted.");

                    this.$emit("created", data);
                });
        }
    }
};
</script>

<style scoped>
.new-reply {
    background-color: #fff;
}
</style>
