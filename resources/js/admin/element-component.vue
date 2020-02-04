<template>
    <div>
        <div v-if="selectedCategories" v-for="category in categories">
            <label>{{category.name}}</label>
            <multiselect
                    multiple
                    v-model="selectedCategories[category.name]"
                    :options="category.items">
                <template v-slot:option="{option}">
                    {{option.name}}
                </template>
                <template v-slot:tag="{option, remove}">
                    <span class="multiselect__tag"><span>{{option.name}}</span> <i @click="removeElem(option.id, category.name)" aria-hidden="true" tabindex="1" class="multiselect__tag-icon"></i></span>
                </template>
            </multiselect>
        </div>
        <input type="hidden" v-for="(select, i) in selected" :name="'element_belongstomany_category_relationship['+i+']'" :value="select">
        <div style="margin-top: 15px">
            <label>Znakowania</label>
            <button type="button" @click="addDefault()" class="btn btn-primary">Dodaj znakowanie</button>
            <div class="row">
                <div class="col-md-4" style="padding: 10px" v-for="(sign, index) in signs">
                    <div class="my-card">
                        <label>Wpisz oznaczenie (litera)</label>
                        <input class="form-control" v-model="sign.sign" placeholder="Wpisz literę">
                        <label>Cena</label>
                        <input class="form-control" v-model="sign.price" type="number" placeholder="Wpisz cenę">
                        <label>Wymiary</label>
                        <input class="form-control" v-model="sign.dimmensions" placeholder="Wpisz wymiary">
                        <button type="button" class="btn btn-danger" @click="signs.splice(index, 1)">Usuń</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: none" v-for="(sign, index) in signs">
            <input :name="'signs['+index+'][id]'" v-if="sign.id" :value="sign.id">
            <input :name="'signs['+index+'][sign]'" :value="sign.sign">
            <input :name="'signs['+index+'][price]'" :value="sign.price">
            <input :name="'signs['+index+'][dimmensions]'" :value="sign.dimmensions">
        </div>
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect'
    import 'vue-multiselect/dist/vue-multiselect.min.css';
    export default {
        components: { Multiselect },
        props:['categories', 'value', 'signs_value'],
        computed:{
            selected(){
                var to_return = [];
                if(this.selectedCategories) {
                    for (var i in this.selectedCategories) {
                        this.selectedCategories[i].forEach(item => {
                            to_return.push(item.id);
                        })
                    }
                    return to_return;
                }
                return [];
            }
        },
        data:() => {return {
            selectedCategories: null,
            signs:[],
        }},
        mounted(){
            if(this.signs_value) this.signs = this.signs_value;
            this.selectedCategories = {}
            this.categories.forEach(item => {
                this.$set(this.selectedCategories, item.name, []);
            })
            if(this.value && typeof this.value == 'object' && this.value.length > 0){
                this.value.forEach(item => {
                    this.selectedCategories[item.type].push(item);
                })
            }
            console.log(this.categories);
        },
        methods:{
            default(){
                return{
                    letter: null,
                    price: null,
                    dimmensions: null
                }
            },
            addDefault(){
                this.signs.push(this.default());
            },
            removeElem(id, type){
                this.selectedCategories[type].splice(this.selectedCategories[type].findIndex(x => x.id == id), 1);
            }
        }
    }
</script>
<style lang="scss">
    .my-card{
        padding: 15px;
        border-radius: 8px;
        -webkit-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.2) !important;
        -moz-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.2) !important;
        box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.2) !important;
    }
</style>
