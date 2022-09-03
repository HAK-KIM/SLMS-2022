<template>
    <section class="px-16 py-4">
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
        <studentTable :students='students' @delete='deleteStudent' @update='updateStudent' class="mt-4"/>
    </section>
    <section >
        <v-overlay v-model="overlay" class="d-flex justify-center align-center">
            <v-progress-circular
                indeterminate
                size="100"
            >Loading</v-progress-circular>
        </v-overlay>
    </section>
</template> 

<script>
import studentTable from '@/components/StudentTableComponent.vue';
import create from '@/components/FormCreateStudent.vue';
import axios from '../axios-http';
export default {
    components: {
        studentTable,
        create,
    },
    data: ()=>({
        students: [],
        alert: false,
        status: '',
        overlay: false,
    }),
    methods: {
        getData() {
            axios.get('/students',  { withCredentials: true })
            .then((response)=>{
                this.overlay = false;
                this.students = response.data;
                console.log(response.data);
            })
        },
        createStudent(student) {
            axios.post('/students', student)
            .then((response)=>{
                console.log(response.data);
                this.getData();
                this.alert = true;
                this.status = 'create';
            })
            console.log('hi');
        },
        deleteStudent(id) {
            axios.delete('/students/'+id)
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
            axios.put('/students/'+id, student)
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
        this.overlay = true;
    },
}
</script>