<template>
    <section class="pa-4">
        <notiCard :students='students'/>
    </section>
</template> 

<script>
import notiCard from '@/components/CardComponent.vue'
import axios from '../axios-http';
export default {
    components: {
        notiCard,
    },
    data: ()=>({
        students: [],
    }),
    methods: {
        getData() {
            axios.get('/users')
            .then((response)=>{
                this.students = response.data;
                console.log(response.data);
            })
        }
    },
    mounted() {
        this.getData();
    },
}
</script>