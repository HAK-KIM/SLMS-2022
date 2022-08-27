<template>
    <section class="pa-4">
        <create @create='createStudent' :type="true" />
         <v-alert
            v-model="alert"
            density="comfortable"
            type="success"
            variant="tonal"
            closable
            border="start"
            class="mt-4"
        >
            Student have been <strong v-if="status=='create'">created </strong> <strong v-else-if="status=='delete'">deleted </strong> <strong v-else-if="status=='update'">updated </strong>successfully.
        </v-alert>
        <card :students='students' @delete='deleteStudent' @update='updateStudent' class="mt-4"/>
    </section>
    <studentDetial />
</template> 

<script>
import card from '@/components/StudentTableComponent.vue';
import create from '@/components/FormCreateStudent.vue';
import studentDetial from '@/components/StudentDetial.vue';
import axios from '../axios-http';
export default {
    components: {
        card,
        create,
        studentDetial
    },
    data: ()=>({
        students: [],
        alert: false,
        status: '',
    }),
    methods: {
        getData() {
            axios.get('/students',  { withCredentials: true })
            .then((response)=>{
                this.students = response.data;
                console.log(response.data);
            })
        },
        createStudent(student) {
            axios.post('/students', student, { withCredentials: true })
            .then((response)=>{
                console.log(response.data);
                this.getData();
                this.alert = true;
                this.status = 'create';
            })
            console.log('hi');
        },
        deleteStudent(id) {
            axios.delete('/students/'+id, { withCredentials: true })
            .then((response)=>{
                for (let i = 0; i < this.students.length; i++) {
                    if (this.students[i].id == id) {
                        this.students.splice(i, 1);
                        this.status = 'delete';
                        this.alert = true;
                    }
                }
                console.log(response.data);
            })
        },
        updateStudent(id, student) {
            axios.put('/students/'+id, student, { withCredentials: true })
            .then((response)=>{
                this.getData()
                this.status = 'update';
                console.log(response.data);
                this.alert = true;
            })
        }
    },
    mounted() {
        this.getData();
    },
}
</script>