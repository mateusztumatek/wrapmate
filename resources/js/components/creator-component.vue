<template>
    <div>
        <md-steppers :md-active-step.sync="active" :class="getClass" md-linear>
            <md-step id="first" md-label="Wybierz model" :md-done.sync="done.first">
                <picker @selectModel="selectModel"></picker>
            </md-step>

            <md-step id="second" md-label="Wgraj pliki" :md-done.sync="done.second">
                <files-uploader @done="uploadedFiles" :model="model" v-if="active == 'second' || files != null"></files-uploader>
            </md-step>

            <md-step id="third" md-label="Złóż zamówienie" :md-done.sync="done.third">
                <confirm :files="files" :model="model"></confirm>
            </md-step>
        </md-steppers>
    </div>
</template>
<script>
    import Picker from './creator/picker'
    import FilesUploader from './creator/files-uploader';
    import Confirm from './creator/confirm';
    export default {
        components:{Picker, FilesUploader, Confirm},
        data:() => {return {
            active: 'first',
            model: null,
            files: null,
            done: {
                first: false,
                second: false,
                third: false
            }
        }},
        computed:{
            getClass(){
                var prop = {};
                prop[this.active] = true;
                return prop;
            }
        },
        methods:{
            selectModel(model){
                this.model = model;
                this.done.first = true;
                this.active = 'second';
            },
            uploadedFiles(files){
                this.files = files;
                this.done.second = true;
                this.active = 'third';
            }
        }
    }
</script>
<style lang="scss">
    .md-steppers{
        .md-stepper{
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        background-color: transparent !important;
        .md-steppers-navigation{
            box-shadow: none !important;
            .md-ripple{
                &:hover{
                    background-color: #f2f2f2 !important;
                }
            }
        }
    }
</style>
