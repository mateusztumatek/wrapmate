<template>
    <div class="messages">
        <transition-group name="slideTop">
            <div :key="index" class="alert" :class="{'alert-danger': message.type == 'error', 'alert-success': message.type == 'success'}" v-for="(message, index) in messages">
                <div class="d-flex flex-wrap justify-content-between">
                    <span>{{message.text}}</span>
                    <div @click="deleteItem(index)" >
                        <md-icon class="ml-auto text-white message-icon" style="margin-right: unset">cancel</md-icon>
                    </div>
                </div>
            </div>
        </transition-group>
    </div>
</template>
<script>
    export default {
        data:() => {return {
            messages:[]
        }},
        mounted() {
            this.$root.$eventBus.$on('addMessage', (data) => {
                this.messages.push(data);
                setTimeout(() => {
                    this.messages = [];
                }, 6000)
            })
        },
        methods:{
            deleteItem(index){
                this.messages.splice(index, 1);
            }
        }
    }
</script>
<style lang="scss">
    .message-icon{
        transition: all 350ms;
        &:hover{
            opacity: 0.6;
            cursor: pointer;
        }
    }
</style>
