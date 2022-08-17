<template>
    <section class="pa-4">
        <notiCard v-for="leave in leaves" :key="leave" :leave='leave'/>
    </section>
</template> 

<script>
import notiCard from '@/components/NotificationComponent.vue'
import axios from 'axios';
export default {
    components: {
        notiCard,
    },
    data: ()=>({
        leaves: [],
        url: 'http://127.0.0.1:8000/api/requests',
    }),
    methods: {
        getData() {
            axios.get(this.url)
            .then((response)=>{
                this.leaves = response.data;
                console.log(response.data);
            })
        }
    },
    mounted() {
        this.getData();
    },
}
</script>