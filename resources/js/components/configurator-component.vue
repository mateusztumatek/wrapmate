<template>
    <div class="give-me-space">
        <div class="banner-section">
            <div class="row">
                <div class="col-md-6 text-right sm-text-center" data-aos="fade-right">
                    <img class="banner-image img-left" v-lazy="$root.base_url+'/default/banner1.png'" />
                    <div class="background-banner"></div>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center sm-text-center" data-aos="fade-left">
                    <div class="col-md-7">
                        <h2>{{$t('Specyfikacja')}}:</h2>
                        <div class="form-group" v-if="!page_id">
                            <md-field>
                                <label for="size">{{$t('Rodzaj torby')}}: </label>
                                <md-select v-model="selected.type" name="size" id="size" @md-selected="changeFilters()">
                                    <md-option v-for="type in types" :value="type">{{type}}</md-option>
                                </md-select>
                                <div style="font-size: 0.8rem; cursor: pointer" @click="clearField('type')" v-if="selected.type" class="d-flex align-items-center text-center"><span>Wyczyść</span></div>
                            </md-field>
                        </div>
                        <div v-if="selected.type || page_id != null">
                            <div class="form-group">
                                <md-field>
                                    <label for="size">{{$t('Rozmiar')}}: </label>
                                    <md-select v-model="selected.size" name="size" id="size" @md-selected="changeFilters()">
                                        <md-option v-for="size in sizes" :value="size">{{size}}</md-option>
                                    </md-select>
                                    <div style="font-size: 0.8rem; cursor: pointer" @click="clearField('size')" v-if="selected.size" class="d-flex align-items-center text-center"><span>Wyczyść</span></div>
                                </md-field>
                            </div>
                            <div class="form-group">
                                <md-field>
                                    <label for="weight">{{$t('Gramatura')}}: </label>
                                    <md-select v-model="selected.weight" name="weight" id="weight" @md-selected="changeFilters()">
                                        <md-option :value="weight" v-for="weight in weights">{{weight}}g/m2</md-option>
                                    </md-select>
                                    <div style="font-size: 0.8rem; cursor: pointer" @click="clearField('weight')" v-if="selected.weight" class="d-flex align-items-center text-center"><span>Wyczyść</span></div>
                                </md-field>
                            </div>
                            <div class="form-group">
                                <md-field>
                                    <label for="package">{{$t('Pakowanie')}}: </label>
                                    <md-select v-model="selected.package" name="package" id="package" @md-selected="changeFilters()">
                                        <md-option v-for="pack in packages" :value="pack">{{pack}}</md-option>
                                    </md-select>
                                    <div style="font-size: 0.8rem; cursor: pointer" @click="clearField('package')" v-if="selected.package" class="d-flex align-items-center text-center"><span>Wyczyść</span></div>
                                </md-field>
                            </div>
                            <transition-group name="fade">
                                <p key="price" class="w-100 my-2 font-weight-bold" style="font-size: 1.2rem" v-if="allSelected()"><span v-if="price != null">{{$t('cena za sztukę')}}: {{price}}zł</span> <span v-else>Brak ceny</span></p>
                                <md-button class="md-raised my-button ml-0" :href="findedItem.url" key="url" v-if="findedItem && findedItem.url">{{$t('Zobacz w sklepie')}}</md-button>
                            </transition-group>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    const distinct = (value, index, self) => {
        if(typeof value == 'undefined') return false;
        return self.indexOf(value) === index;
    }
    export default {
        props:['page_id'],
        data(){
            return{
                configs: [],
                price: null,
                selected:{},
                size: null,
                isLoading: false,
            }
        },
        mounted(){
            this.getConfigs();
        },
        computed:{
            findedItem(){
                if(this.allSelected()){
                    var item = this.configs.filter(item => {
                        if(item.size = this.selected.size && item.weight == this.selected.weight && item.packages == this.selected.packages){
                            if(!this.page_id){
                                return item.type == this.selected.type;
                            }
                            return true;
                        }else{
                            return false;
                        }
                    })
                    if(item.length > 0) return item[0];
                }
                return null;
            },
            types: function () {
                var arr = this.configs.map((item) => {
                    return item.type
                });
                var filtered = arr.filter(distinct)
                return filtered;
            },
            sizes: function () {
                var arr = this.configs.map((item) => {
                    if(item.type == this.selected.type || this.page_id != null){
                        return item.size
                    }
                });
                var filtered = arr.filter(distinct)
                return filtered;
            },
            weights: function () {
                var arr = this.configs.map((item) => {
                    if(item.type == this.selected.type || this.page_id != null) {
                        return item.weight;
                    }
                })
                var filtered = arr.filter(distinct)
                return filtered;
            },
            packages: function () {
                var arr = this.configs.map((item) => {
                    if(item.type == this.selected.type || this.page_id != null) {
                        return item.package;
                    }
                })
                var filtered = arr.filter(distinct)
                return filtered;
            }
        },
        methods:{
            clearField(field){
                if(field == 'type'){
                    this.selected = {};
                }
                this.selected[field] = null;
                this.getConfigs();
            },
            getConfigs(){
                this.isLoading = true;
                var data = {params: this.selected};
                if(this.page_id) data.params.page_id = this.page_id;
                console.log('DATA', data);
                axios.get(base_url+'/configs', data).then(response => {
                    this.configs = response.data;
                    this.isLoading = false;
                })
            },
            allSelected(){
                if(this.selected.size && this.selected.weight && this.selected.package) return true
                else return false;
            },
            changeFilters(){
                this.getConfigs();
                if(this.allSelected()){
                    if(this.configs.length > 0) this.price = this.configs[0].price;
                }
            }
        }
    }
</script>
<style scoped lang="scss">
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
