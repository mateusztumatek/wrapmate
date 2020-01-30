<template>
    <div class="give-me-space">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-center s-mb-3" data-aos="fade-right">
                <div class="col-lg-8 col-md-10 col-12">
                    <h2 style="font-size: 2rem; font-weight: 200; text-transform: uppercase">{{post.title}}</h2>
                    <p class="mt-3" v-html="post.content"></p>
                    <md-button class="md-raised my-button" :href="(!validURL(post.url))? $root.base_url+'/'+post.url : post.url">{{$t('Dowiedz się więcej')}}</md-button>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <div class="background position-relative">
                    <img :src="$root.base_url+'/storage/'+post.image">
                    <div class="tip" v-for="tip in tips" v-bind:style="{'left': tip.left, 'top': tip.top}" @click="changeActiveTip(tip)" v-bind:class="{'active-tip': active_tip && active_tip.id == tip.id}">
                        <div class="trigger">
                            <div class="bar-1"></div>
                            <div class="bar-2"></div>
                        </div>
                        <div class="content" v-if="active_tip && active_tip.id == tip.id">
                            <h2>{{tip.title}}</h2>
                            <p>{{tip.content}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props:['post'],
        data(){
            return{
                active_tip: null,
                tips:[
                    {
                        id: 1,
                        left: '25%',
                        top: '75%',
                        title: 'Duża wytrzymałość',
                        content: 'torby papierowe z uchwytem skręcanym z papieru białego (80-120 g/m2). Wykorzystywany w produkcji papier Kraft zapewnia torbom dużą wytrzymałość – do 12 kg.'
                    },
                    {
                        id: 2,
                        left: '65%',
                        top: '8%',
                        title: 'całkowicie ekologiczne',
                        content: 'Przyjazne dla środowiska, ponieważ zarówno rodzaje papieru, które wykorzystujemy do produkcji toreb (papier kraft) jak i materiały (bawełna, juta) są w stu procentach biodegradowalne.'
                    },
                    {
                        id: 3,
                        left: '75%',
                        top: '55%',
                        title: 'Duża wytrzymałość',
                        content: 'torby papierowe z uchwytem skręcanym z papieru białego (80-120 g/m2). Wykorzystywany w produkcji papier Kraft zapewnia torbom dużą wytrzymałość – do 12 kg.'
                    },
                ]
            }
        },
        mounted(){

        },
        methods:{
            changeActiveTip(tip){
                if(this.active_tip == tip) this.active_tip = null;
                else this.active_tip = tip;
                $(document).ready(() => {
                    $('.content').css('top', -($('.content').height() + 30)+'px');
                    if($(window).width() < 1000){
                        if($('.content')){
                            var left = $('.active-tip').css('left');
                            $('.content').css('left', '-'+left);
                            $('html, body').animate({scrollTop: $(".content").offset().top - $('.content').height()}, 300);
                            if(typeof $('.content').offset() != 'undefined'){
                                $('.content').css('left', $('.content').position().left + 50+'px');
                            }

                        }
                    }
                })

            }
        }
    }
</script>
<style scoped lang="scss">
    @import "../../../resources/sass/variables";
    .active-tip{
        transform: scale(1.1);
        .bar-2{
            transform: rotate(0deg);
        }
    }
    .bar-1, .bar-2{
        transition: all 300ms;
        transition-timing-function: ease-out;
        width: 60%;
        height: 2px;
        background-color: $black-color;
    }
    .bar-2{
        transform: rotate(90deg);
        position: absolute;
    }
    .tip{
        .trigger{
            &:after{
                content: "";
                border-radius: 100%;
                border: 2px solid $black-color;
                width: 90%;
                height: 90%;
                position: absolute;

            }
            height: 100%;
            width:100%;
            display:flex;
            justify-content: center;
            align-items:center;

        }
        transition: all 200ms;
        position: absolute;
        border: 1px solid $black-color;
        height: 50px;
        width: 50px;
        border-radius: 100%;
        .content{
            h2{
                font-size: 1.2rem;
            }
            p{
                font-size: 0.7rem;
            }
            color: white;
            background-color: rgba(#2D2D2D, 0.6);
            padding: 8px;
            animation: slideIn;
            animation-fill-mode: forwards;
            animation-timing-function: ease-out;
            animation-duration: 300ms;
            position: absolute;
            width: 400px;
            right: 0px;
        }
    }
    @keyframes slideIn{
        0%{
            opacity: 0;
            transform: translateY(-30px);
        }
        100%{
            opacity: 1;
            transform: translateY(0px);
        }
    }
    .background{
        width: 100%;
        height: 600px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: $primary-color;
        img{
            height: 650px;
            object-fit:contain;
        }
    }
    @media screen and (max-width: 1000px){
        .tip{
            .content{
                width: 310px;
            }
        }
        .background{
            height: 400px;
            img{
                margin-right: 20px;
                height: 390px;
            }
        }
    }
</style>
