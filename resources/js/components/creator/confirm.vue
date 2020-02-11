<template>
    <div>
        <h2>Złóż zamówienie</h2>
        <div v-if="!files || files.length == 0" class="alert alert-info">Aby złożyć zamówienie musisz wgrać jakiś projekt</div>
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
            <div class="my-2">
                <md-field>
                    <label>Wybierz typ płatności</label>
                    <md-select v-model="order.payment_type">
                        <md-option v-for="type in payment_types" :value="type.value">{{type.name}}</md-option>
                    </md-select>
                </md-field>
            </div>
            <div class="my-3" v-if="order.payment_type == 'tpay'">
                <label>Wybierz Bank do płatności</label>
                <div class="row">
                    <div class="col-md-2" v-for="bank in banks">
                        <md-card :class="{'md-primary': order.group_id == bank.id}" class="m-1">
                            <md-card-header>
                                <md-card-header-text>
                                    <div class="md-title" style="font-size: 1rem">{{bank.name | truncate(16, '..')}}</div>
                                </md-card-header-text>
                            </md-card-header>
                            <md-card-media style="width: 100%">
                                <img :src="$root.base_url+'/bank_image/'+getImageSlug(bank)" :alt="bank.name">
                            </md-card-media>
                            <md-card-actions>
                                <md-button @click="$set(order, 'group_id', bank.id)" class="md-raised md-primary">
                                    Wybierz bank
                                </md-button>
                            </md-card-actions>
                        </md-card>
                    </div>
                </div>
            </div>
            <md-field>
                <label>Uwagi do zamwienia</label>
                <md-textarea class="w-100" v-model="order.info"></md-textarea>
            </md-field>
            <md-button :disabled="loading || !files || files.length == 0" type="submit" class="md-raised md-primary">Złóż zamówienie</md-button>
        </form>
        <transition-group name="fade">
            <div :key="index" v-if="errors" v-for="(er, index) in errors">
                <div class="alert alert-danger" v-for="e in er">{{e}}</div>
            </div>
        </transition-group>
    </div>
</template>
<script>
    import {startDownload} from "../../utilies/helpers";
    import {storeOrder, getBankLists} from "../../api/order";
    import {validationMixin} from 'vuelidate';
    import {
        required,
        email,
    } from 'vuelidate/lib/validators'
    export default {
        props:{files: null, model: null},
        mixins:[validationMixin],
        data:() => {return {
            payment_types:[{name: 'Przelew bankowy', value: 'bank'}, {name: 'Przelew online', value: 'tpay'}],
            banks:[],
            loading: false,
            order:{
                payment_type: null,
                /*email: 'mbielak@ideashirt.pl',
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
        mounted(){
            this.getBanks();
        },
        methods:{
            getImageSlug(bank){
                var parts = bank.img.split('/');
                var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash
                return lastSegment;
            },
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
            getBanks(){
                getBankLists().then(response => {
                    this.banks = response;
                   /* for(var i in this.banks){
                        image = startDownload(this.banks[i].img);
                        break;
                    }*/
                }).catch(e => {
                   this.errors = e.response.data.errors;
                })
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
                if(this.order.payment_type == 'tpay' && (this.order.group_id == null || this.order.group_id == '')){
                    this.errors = [];
                    this.errors.push({'Bank': 'Musisz wybrać bank z listy'});
                    setTimeout(() => {this.errors = []}, 5000);
                    return null;
                }
                if(!this.$v.$invalid){
                    this.save();
                }
            }
        }
    }
</script>
