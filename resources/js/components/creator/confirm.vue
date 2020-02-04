<template>
    <div>
        <h2>Złóż zamówienie</h2>
        <md-list>
            <md-list-item v-for="item in files">
                <md-button class="md-primary" download :href="$root.getSrc(item.file)">Pobierz plik</md-button>
                <p class="mb-0">Sekcja {{item.sign.sign}}</p>
            </md-list-item>
        </md-list>
        <form novalidate @submit.prevent="validateOrder">
            <div class="d-flex justify-content-center align-items-center my-4" v-if="loading">
                <loading :loading="loading"></loading>
            </div>
            <md-field :class="getValidationClass('email')">
                <label>Adres email</label>
                <md-input v-model="order.email"></md-input>
                <span class="md-error" v-if="!$v.order.email.required">Te pole jest wymagane</span>
                <span class="md-error" v-if="!$v.order.email.email">Te pole musi być poprawnym adresem email</span>
            </md-field>
            <md-field :class="getValidationClass('name')">
                <label>Imię i nazwisko</label>
                <md-input v-model="order.name"></md-input>
                <span class="md-error" v-if="!$v.order.name.required">Te pole jest wymagane</span>
            </md-field>
            <div class="row">
                <div class="col-md-6">
                    <md-field :class="getValidationClass('city')">
                        <label>Miasto</label>
                        <md-input v-model="order.city"></md-input>
                        <span class="md-error" v-if="!$v.order.city.required">Te pole jest wymagane</span>
                    </md-field>
                </div>
                <div class="col-md-3">
                    <md-field :class="getValidationClass('postal')">
                        <label>Kod pocztowy</label>
                        <md-input v-model="order.postal"></md-input>
                        <span class="md-error" v-if="!$v.order.postal.required">Te pole jest wymagane</span>
                    </md-field>
                </div>
                <div class="col-md-3">
                    <md-field :class="getValidationClass('street')">
                        <label>Ulica i numer domu</label>
                        <md-input v-model="order.street"></md-input>
                        <span class="md-error" v-if="!$v.order.street.required">Te pole jest wymagane</span>
                    </md-field>
                </div>
            </div>

            <md-field>
                <label>Uwagi do zamwienia</label>
                <md-textarea class="w-100" v-model="order.info"></md-textarea>
            </md-field>
            <md-button :disabled="loading" type="submit" class="md-raised md-primary">Złóż zamówienie</md-button>
        </form>
        <transition-group name="fade">
            <div :key="index" v-if="errors" v-for="(er, index) in errors">
                <div class="alert alert-danger" v-for="e in er">{{e}}</div>
            </div>
        </transition-group>
    </div>
</template>
<script>
    import {storeOrder} from "../../api/order";
    import {validationMixin} from 'vuelidate';
    import {
        required,
        email,
    } from 'vuelidate/lib/validators'
    export default {
        props:{files: null, model: null},
        mixins:[validationMixin],
        data:() => {return {
            loading: false,
            order:{
               /* email: 'mbielak@ideashirt.pl',
                name: 'Mateusz Bielak',
                city: 'Wrocław',
                street: 'Traugutta 39',
                postal: '22-222',*/
            },
            errors:null,
        }},
        validations:{
            order:{
                name: {
                    required
                },
                email:{required, email},
                city:{required},
                postal:{required},
                street:{required},
            }
        },
        methods:{
            getValidationClass (fieldName) {
                if(this.$v){
                    const field = this.$v.order[fieldName];
                    if (field) {
                        return {
                            'md-invalid': field.$invalid && field.$dirty
                        }
                    }
                }
            },
            save(){
                this.loading = true;
                var model = this.model;
                model.categories = null;
                model.signs = null;
                var data = {...this.order, project: {model: model, files:this.files}};
                storeOrder(data).then(response => {
                    this.loading = false;
                    if(response.redirect){
                        window.location.href = response.redirect;
                    }
                }).catch(e => {
                    this.loading = false;
                    this.errors = e.response.data.errors;
                    setTimeout(() => {this.errors = null}, 5000);
                })
            },
            validateOrder(){
                this.$v.$touch();
                if(!this.$v.$invalid){
                    this.save();
                }
            }
        }
    }
</script>
