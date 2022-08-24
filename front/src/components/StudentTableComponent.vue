<template>
    <v-table
        class="rounded mx-auto elevation-6"
    >
        <thead>
        <tr style="background-color: #04e; width: 100%">
            <th v-for:="item in headers" class="text-left text-white text-uppercase" style="font-size: 16px;">{{item}}</th>
        </tr>
        </thead>
        <tbody>
        <p class="text-h6 text-error pa-3" v-if="students.length==0">No students!</p>
        <tr v-for:="student in students">
            <td >{{ student.id }}</td>
            <td >{{ student.firstName }}</td>
            <td >{{ student.lastName }}</td>
            <td>{{ student.email }}</td>         
            <td>{{ student.batch }}</td>         
            <td>{{ student.gender }}</td>    
            <td>{{ student.phone }}</td>    
            <td class="d-flex text-center pa-3">
                <modal :type="false" :student="student" :id="student.id" @update='updateStudent'/>
                <v-actions @click="deleteStudent(student.id)" style="background-color: #e04;" class="ml-1">
                    <span>Delete</span>
                </v-actions>
            </td>
        </tr>
        </tbody>
    </v-table>
</template>

<script>
import modal from '../components/FormCreateStudent.vue'
import Swal from 'sweetalert2'
    export default {
        components: {
            modal,
        },
        props: ['students'],
        emits: ['delete', 'update'],
        data() {
            return {
                headers: ['student Id', 'firstname', 'lastname', 'email', 'batch', 'gender', 'phone', 'action'],
            }
        },
        methods: {
            deleteStudent(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.$emit('delete', id)
                        }
                    })
            },
            updateStudent(id, body) {
                this.$emit('update',id, body);
            }
        }
    }
</script>

<style scoped>
  v-actions {
    cursor: pointer;
    padding: 5px 15px;
    border-radius:10px;
    color: #fff;
    display: flex;
    align-items: center;
  }
</style>