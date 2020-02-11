<template>
    <div>
        <div class="row">
            <div class="col-md-6">
               <!-- <md-field v-if="brands">
                    <label for="brands">Wybierz markę</label>
                    <md-select v-model="selected.brand" name="brands">
                        <md-option :value="brand.id" v-for="brand in brands">{{brand.name}}</md-option>
                    </md-select>
                </md-field>-->
                <md-autocomplete name="brand" md-input-id="id" md-input-name="name" v-model="selected.brand" :md-options="brands" v-if="brands">
                    <label>Wybierz markę</label>
                </md-autocomplete>
            </div>
        </div>
    </div>
</template>
<script>
    import {getBrands} from "../api/api";

    export default {
        data:() => {return {
            brands:null,
            selected:{},
        }},
        mounted() {
            this.getBrands();
        },
        methods:{
            getBrands(){
                getBrands().then(response => {
                    this.brands = response;
                })
            }
        }
    }
</script>
