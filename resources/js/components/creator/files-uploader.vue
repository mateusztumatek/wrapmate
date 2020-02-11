<template>
    <div>
        <div class="row">
            <div class="col-md-5">
                <img :src="$root.getSrc(model.image_pattern)" class="w-100" style="max-height: 700px; object-fit: contain">
            </div>
            <div class="col-md-7">
                <md-list class="md-double-line">
                    <md-list-item v-for="sign in model.signs" :class="{'background-primary': files.findIndex(x => x.sign.id == sign.id) != -1}">
                        <span style="font-size: 3rem; font-weight: bold">{{sign.sign}}</span>
                        <p class="mb-0">Cena za nadruk w tej strefie: {{sign.price}}
                        <span v-if="sign.dimmensions" style="font-size: 0.8rem" class="text-grey"><br> {{sign.dimmensions}}</span>
                        </p>
                        <md-button :disabled="loading" v-if="files.findIndex(x => x.sign.id == sign.id) == -1" @click="uploadFiles(sign)" class="md-raised md-accent">Wgraj projekt</md-button>
                        <md-button :disabled="loading" v-else @click="deleteProject(sign.id)" class="md-raised md-accent">Usuń projekt</md-button>
                    </md-list-item>
                </md-list>
                <div class="d-flex justify-content-center align-items-center my-4">
                    <loading :loading="loading"></loading>
                </div>

                <div v-if="files.length > 0" class="mt-4">
                    <div class="d-flex justify-content-between" v-for="file in files">
                        <p>
                            Nadruk w strefie {{file.sign.sign}}, <span class="font-weight-bold">{{file.sign.price}}zł</span>
                        </p>
                        <md-button class="md-primary" download :href="$root.getSrc(file.file)">Pobierz projekt</md-button>
                    </div>
                    <md-divider></md-divider>
                </div>
                <p class="mt-3">Cena całkowita: <span class="font-weight-bold">{{totalPrice | currency('PLN', 2)}}</span></p>
                <md-button :disabled="loading" v-if="files.length > 0" @click="nextStep()" class="md-raised md-primary">Dalej</md-button>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        props:{model: Object},
        data:() => {return {
           files:[],
            loading: false,
        }},
        computed:{
            totalPrice(){
                var price = 0;
                this.files.forEach(item => {
                    price = price + item.sign.price;
                });
                return price;
            }
        },
        mounted(){
            this.$root.$eventBus.$on('startLoading', () => {
                this.loading = true;
            })
            this.$root.$eventBus.$on('stopLoading', () => {
                this.loading = false;
            });

/*
            this.files.push({sign: this.model.signs[0], file: '/default/autko.png'});
*/

        },
        methods:{
            uploadFiles(zone){
                var index = this.files.findIndex(x => x.sign.id == zone.id);
                this.$uploader().then(response => {
                    if(index != -1){
                        this.files[index].file = response[0];
                    }else{
                        this.files.push({sign: zone, file: response[0]});
                    }
                })
            },
            deleteProject(sign_id){
                this.files.splice(this.files.findIndex(x => x.sign.id == sign_id), 1);
            },
            nextStep(){
                this.$emit('done', this.files);
            }
        }
    }
</script>
