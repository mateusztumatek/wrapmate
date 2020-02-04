<template>
    <div>
        <filter-component @categories="changeCategories" :categories="categories"></filter-component>
        <div class="row" v-if="items">
            <div class="col-md-3 my-2" v-for="(item, index) in items.data">
                <div @mouseover="$set(items.data[index], 'isHover', true)" @mouseleave="items.data[index].isHover = false">
                    <md-card class="my-card">
                        <md-card-media-cover style="height: 300px" >
                            <md-card-media>
                                <transition name="fade">
                                    <img style="height: 300px; object-fit:cover" :key="item.id" :src="getSrc(item.image)" alt="Skyscraper" v-if="!item.isHover">
                                </transition>
                                <transition-group name="fade">
                                    <img style="height: 300px; object-fit:cover" :key="item.id" :src="getSrc(item.image_pattern)" alt="Skyscraper" v-if="item.isHover">
                                </transition-group>
                                <div key="btn" style="position: absolute; z-index:100; top: 0px">
                                    <md-button @click="$emit('selectModel', item)" class="md-raised md-primary">Wybierz model</md-button>
                                </div>
                            </md-card-media>

                            <md-card-area>
                                <md-card-header style="margin-bottom: 0px; background-color: rgba(0, 0, 0, 0.3)">
                                    <span class="md-title">{{item.name}}</span>
                                </md-card-header>
                            </md-card-area>
                        </md-card-media-cover>
                    </md-card>
                </div>
            </div>
        </div>
        <div>
            <ul role="navigation" class="pagination">
                <li class="page-item"><a style="cursor:pointer" @click="getPage(1)" class="page-link">‹</a></li>
                <li v-for="page in items.last_page" aria-current="page" class="page-item" :class="{'active': items.current_page == page}"><span @click="getPage(page)" style="cursor: pointer" class="page-link">{{page}}</span></li>
                <li class="page-item"><a style="cursor:pointer" @click="getPage(items.last_page)" class="page-link">›</a></li>
            </ul>
        </div>
    </div>
</template>
<script>
    import {getElements} from "../../api/elements";
    import FilterComponent from "./filters"
    export default{
        components:{FilterComponent},
        data:() => {return {
            params:{
                page: 1,
            },
            items:[],
            selectedCategories: null,
            categories: null,
        }},
        mounted() {
            this.getItems();
        },
        methods:{
            getPage(page){
                this.params.page = page;
                this.getItems();
            },
            changeCategories(categories){
                this.selectedCategories = categories;
                this.getItems();
            },
            getItems(){
                getElements({categories: this.selectedCategories, ...this.params}).then(res => {
                    this.items = res.elements;
                    if(res.categories){
                        this.categories = res.categories;
                    }
                })
            }
        }

    }
</script>
<style lang="scss">
    .my-card{
        .md-card-media-cover{
            overflow: hidden;
        }
        .md-card-area{
            transition: all 200ms;
        }
        &:hover{
            .md-card-area{
                bottom: -100%;
            }
        }
    }
</style>
