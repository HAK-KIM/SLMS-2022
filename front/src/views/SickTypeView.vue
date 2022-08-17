<template>
    <card v-for="leave in leaves" :key="leave" :leave='leave'/>
</template> 

<script>
import card from '@/components/CardComponent.vue';
import axios from 'axios';
export default {
    components: {
        card,
    },
    data: ()=>({
        leaves: [],
        url: 'http://127.0.0.1:8000/api/requests',
    }),
    methods: {
        getData() {
            axios.get(this.url)
            .then((response)=>{
                this.leaves = response.data.filter((item)=>item.leave_type == 'Sick');
                console.log(response.data);
            })
        }
    },
    mounted() {
        this.getData();
    },
}
</script>