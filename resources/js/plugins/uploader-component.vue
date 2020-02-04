<template>
    <div>
        <input @change="uploadFile" type="file" name="uploader" ref="uploader">
    </div>
</template>
<script>
    import {upload} from "../api/upload";

    export default {
        methods:{
            uploadFile(event){
                this.$emit('startUpload');
                var data = new FormData();
                data.append('file', event.target.files[0]);
                upload(data, 'client').then(response => {
                    this.$emit('uploaded', response);
                    this.$emit('stopUpload');
                })
            }
        },
        mounted() {
            this.$refs.uploader.click();
        }
    }
</script>
