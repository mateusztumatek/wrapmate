<template>
    <div>
        <md-card class="mb-4" style="box-shadow: none !important;">
            <md-card-header>
                Filtry
            </md-card-header>
            <md-card-content>
                <div class="row">
                    <div class="col-md-4" v-for="(category, i) in categories">
                        <md-field class="no-validation">
                            <label>{{i}}</label>
                            <md-select multiple v-model="selected">
                                <md-option :value="item.id" v-for="item in category">{{item.name}}</md-option>
                            </md-select>
                        </md-field>
                    </div>
                </div>
            </md-card-content>
        </md-card>
    </div>
</template>
<script>
    export default{
        props:['categories'],
        watch:{
            selected: function () {
                if(this.timeout){
                    this.$emit('categories', this.selected);
                }
            }
        },
        data:() => {return {
            timeout:false,
            selected: null,
        }},
        mounted() {
            setTimeout(() => {this.timeout = true;}, 1000);
        }
    }
</script>
