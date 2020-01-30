<template>
    <div class="give-me-space">
        <div class="container" data-aos="fade-up" v-if="message == null">
            <div class="col-lg-8 col-md-10 col-12 m-auto">
                <h3 style="font-size: 1.6rem" class="font-weight-bold mb-4">{{$t('Kontakt')}}</h3>
                <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <input :placeholder="$t('Imię i nazwisko')" name="name" v-model="contact.name" class="form-control" :disabled="loading">
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <div class="form-group">
                            <input :disabled="loading" :placeholder="$t('Adres email')" v-model="contact.email" name="email" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea :disabled="loading" name="content" v-model="contact.content" class="form-control"></textarea>
                </div>
                <md-button :disabled="loading" class="md-raised my-button ml-0" style="width: auto !important;" @click="sendEmail()">{{$t('Wyślij')}}</md-button>
                <div class="errors">
                    <div v-for="error in errors">
                        <div v-for="e in error" class="alert alert-danger" >{{e}}</div>
                    </div>
                </div>
                <div class="alert alert-info" v-if="message">{{message}}</div>
            </div>
        </div>
        <div v-else class="text-center w-100">
            <img style="max-width: 150px" :src="$root.base_url+'/default/sent.png'">
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                contact:{},
                errors:[],
                message: null,
                loading: false
            }
        },
        methods:{
            sendEmail(){
                this.loading = true;
                axios.post(this.$root.base_url+'/sendEmail', this.contact).then(response => {
                    this.message = 'Wiadomość została wysłana poprawnie';
                    this.loading = false;
                }).catch(e => {
                    this.loading = false;
                    this.errors = e.response.data.errors;
                    setTimeout(() => {
                        this.errors = [];
                    }, 3000)
                })
            }
        }
    }
</script>
