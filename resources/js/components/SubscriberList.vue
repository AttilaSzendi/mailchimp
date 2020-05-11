<template>
    <ul class="list-group">
        <li v-for="item in users" :key="item.name" class="list-group-item d-flex justify-content-between align-items-center">
            {{ item.name }}
            <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="..."
                @click="toggleSubscriptionCheckbox(item.id, item.newsletterSubscription)"
               :checked="item.newsletterSubscription"
            >
        </li>
    </ul>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/subscribers')
                .then((response) => {
                    this.users = response.data.data
                })
                .catch((error) => {
                    console.log(error)
                })
        },

        data () {
            return {
                users: [],
                selectedUserId: null,
                newSubscriptionState: false,
            }
        },
        methods: {
            toggleSubscriptionCheckbox(userId, currentSubscriptionState) {
                console.log(currentSubscriptionState)
                this.selectedUserId = userId
                this.newSubscriptionState = !currentSubscriptionState

                let user = this.users.find(function(user) {
                    return user.id === userId;
                });

                user.newsletterSubscription = !user.newsletterSubscription

                if(this.newSubscriptionState === true) {
                    return this.subscribe();
                }

                return this.unsubscribe();
            },

            subscribe() {
                axios.patch('/api/subscribe', {
                    userId: this.selectedUserId
                })
                    .then((response) => {
                        console.log(response)
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },

            unsubscribe() {
                axios.patch('/api/unsubscribe', {
                    userId: this.selectedUserId
                })
                    .then((response) => {
                        console.log(response)
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        }
    }
</script>
