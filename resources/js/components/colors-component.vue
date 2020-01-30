<template>
    <div>
        <div class="give-me-space" v-if="data && data.length > 0">
            <div class="row background-primary">
                <div class="col-md-6 align-items-center d-flex" data-aos="fade-right">
                    <div class="color-content">
                        <div class="holder">
                            <h3 class="w-100">{{$t('available_colors')}}:</h3>
                            <div class="colors">
                                <div @click="changeColor(color)" class="color" v-bind:style="{'background-color': color.hex_color, 'box-shadow': (selected_color.id == color.id)? getSelectedShadow() : ''}" v-for="color in data" v-bind:class="{'selected': selected_color.id == color.id}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center position:relative" data-aos="fade-left">
                    <div class="background" v-bind:style="{'background-color': (selected_color.id)? selected_color.hex_color : null}"></div>
                    <div class="animation-background" v-if="change" v-bind:style="{'background-color': change.hex_color}"></div>
                    <div class="image-holder">
                        <img style="z-index: 10000" :src="$root.base_url+'/storage/'+selected_color.image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {hexToRgb} from "../functions";

    export default {
        props:['arr', 'page_id'],
        data(){
            return{
                loop: 0,
                change: null,
                selected_color: {},
                size: null,
                data: null,
            }
        },
        mounted(){
            if(!this.arr){
                this.getColors();
            }else{
                this.data = this.arr;
                this.selected_color = this.data[this.loop];
                setInterval(() => {
                    if(this.loop != null){
                        this.change = this.selected_color;
                        if(this.loop != null){
                            this.loop = this.loop + 1;
                            if(this.data[this.loop]){
                                this.selected_color = this.data[this.loop];
                            }else{
                                this.loop = 0;
                                this.selected_color = this.data[this.loop];
                            }
                        }
                        setTimeout(() => {
                            this.change = null;
                        }, 500)
                    }
                },4000);
            }
        },
        methods:{
            getColors(){
                var data = {params:{}};
                if(this.page_id){
                    data.params.page_id = this.page_id;
                }
                axios.get(base_url+'/colors', data).then(({data}) => {
                    this.data = data;
                    this.selected_color = this.data[this.loop];
                })
            },
            getSelectedShadow(){
                var rgb = hexToRgb(this.selected_color.hex_color);
                return '4px 4px 8px -2px rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.4)';
            },
            changeColor(color){
                this.loop = null;
                this.change = this.selected_color;

                this.selected_color = color;
                setTimeout(() => {
                    this.change = null;
                }, 500)
            }
        }
    }
</script>
<style lang="scss" scoped>
    @import "../../sass/variables";
    .background{
        min-height: 800px;
        width: 52%;
        margin-left:auto;
    }
    .color-content{
        .holder{
            width: 85%;;
            margin-left: auto;
        }
        background-color: $body-bg;
        width: 85%;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }

    .colors{
        transition: all 300ms;
        display: flex;
        .color{
            &:hover{
                transform: scale(1.02);
            }
            border: 1px solid #d0d0d0;
            margin: 10px;
            width: 30px;
            height: 30px;
            border-radius: 100%;
        }
    }
    @keyframes fadeInRight {
        0%{
            opacity: 1;
        }
        100%{
            opacity: 0;
        }
    }
    .animation-background{
        animation: fadeInRight;
        animation-duration: 250ms;
        animation-fill-mode: forwards;
        animation-timing-function: ease-in-out;
        height: 800px;
        width: 52%;
        position: absolute;
        right: 0px;
        top: 0px;
        background-color: black;
    }
    .selected{
        border: 1px solid #bcbcbc;
        transform: scale(1.05);
    }
    .image-holder{

        img{
            height: 100%;
        }
        width: 80%;
        height: 100%;
        left: 10%;
        top: 0px;
        content: "";
        position: absolute;
    }
    @media screen and (max-width: 1000px){
        .animation-background{
            height: 400px;
        }
        .background{
            min-height: 400px !important;
        }
        .color-content{
            width: 100%;
            .holder{
                max-width: 100%;
                margin: auto !important;
            }
        }

    }
</style>
