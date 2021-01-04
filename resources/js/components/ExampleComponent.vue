<template>
    <div class="container p-0 m-0">
        <i class="fas fa-heart" style="color:#ef3961;" v-if="flag == true" @click="addIine"><span> {{count}} </span></i>

        <i class="fas fa-heart" v-else @click="addIine"><span> {{count}} </span></i>
    </div>
</template>

<script>
    const axios = require('axios');
    export default {
        props:[
            'post_id',
            'user_id',
        ],
        
        data(){
            return {
                flag:false,
                count:0,
            };
        },

        mounted(){
            let dataform1 = new FormData();
                dataform1.append('post_id', this.post_id);
                dataform1.append('user_id', this.user_id);
                axios.post('json/get', dataform1).then(respons => {
                    this.flag = respons.data.res;
                    console.log(this.flag);
                });
            let dataform2 = new FormData();
                dataform2.append('post_id', this.post_id);
                axios.post('json/count', dataform2).then(respons => {
                    this.count = respons.data;
                    console.log(this.count);
                });
        },


        methods:{
            addIine(){
                let dataform1 = new FormData();
                dataform1.append('post_id', this.post_id);
                dataform1.append('user_id', this.user_id);
                axios.post('json/add', dataform1).then(respons => {
                    this.flag = respons.data.res;
                    console.log(this.flag);
                });
            if(this.flag == false){
                this.count += 1;
            } else {
                this.count -= 1;
            }
            },
        },

        watch: {
            flag: function(newVal){
                this.flag = newVal;
            },
            count: function(newVal){
                this.count = newVal;
            },
        }
    }
</script>
