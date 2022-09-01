
<template>
    <section>
    <v-col cols = "2" sm="3" class="mt-4">
    <v-select 
      :items = "batches"
      label = "Select By Batches"
      variant = "outlined"
      v-model="filter"
    ></v-select>
    </v-col>
    </section>
    <section class="px-2 pb-3">
  </section>
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
        <v-dialog
            v-model="dialog"
            persistent
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <v-card>
                <v-toolbar
                    color="primary"
                >
                    <v-toolbar-title>Student Detail</v-toolbar-title>
                    <v-icon @click="dialog = false" class="mr-4">mdi-close</v-icon>
                </v-toolbar>
                <v-list class="px-4">
                    <studentInfo :student='student' elevation="6"/>
                    <leave class=" rounded" elevation="6" :items='items' :leaves='leaves' :noAction='true'/>
                </v-list>
            </v-card>
        </v-dialog>
        <tr v-for:="(student, index) in filterData">
            <td @click="getLeaveAndStudent(student.id)">{{student.student_ID}}</td>
            <td @click="getLeaveAndStudent(student.id)">{{student.firstName}}</td>
            <td @click="getLeaveAndStudent(student.id)">{{student.lastName}}</td>
            <td @click="getLeaveAndStudent(student.id)">{{student.email}}</td>
            <td @click="getLeaveAndStudent(student.id)">{{student.batch}}</td>
            <td @click="getLeaveAndStudent(student.id)">{{student.gender}}</td>
            <td @click="getLeaveAndStudent(student.id)">{{student.phone}}</td>
            <td class="d-flex text-center pa-3 noAction">
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
import leave from '../components/LeaveComponent.vue';
import studentInfo from '../components/StudentInformation.vue';
import Swal from 'sweetalert2'
import axios from '../axios-http.js'
    export default {
        components: {
            modal,
            leave,
            studentInfo
        },
        props: ['students'],
        emits: ['delete', 'update'],
        data() {
            return {
                dialog: false,
                items: ['Type Leave', 'From', 'To', 'Status', 'Reason', 'Duration'],
                headers: ['student Id', 'firstname', 'lastname', 'email', 'batch', 'gender', 'phone', 'action'],
                batches: ['All','2022', '2023'],
                leaves: [],
                student:{},
                filter: 'All',
            }   
        },

        computed: {
            filterData(){
                let baches = this.students;
                if (this.filter == "2022") {
                    baches = this.getStudentBatches2022();
                }else if (this.filter == "2023") {
                    baches = this.getStudentBatches2023();
                }
                return baches;
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
            },
            getLeaveAndStudent(id) {
                    this.dialog=true;
                    for (let student of this.students) {
                        if (id == student.id) {
                            this.leaves=student.leaves;
                            this.student=student;
                        }
                    }
            },
            getStudentBatches2022() {
                let baches = [];
                for (let student of this.students) {
                    if (student.batch == '2022') {
                        baches.unshift(student);
                    }
                }
                return baches;
            },
            getStudentBatches2023() {
                let baches = [];
                for (let student of this.students) {
                    if (student.batch == '2023') {
                        baches.unshift(student);
                    }
                }
                return baches;
            },
            sendAllData(id, ) {
                let body = {
                    actionurl: 'http://lo calhost:8080/',
                }
                axios.post('user//email/' +id, body)
                .then((response =>{{
                    console.log(response.data);
                }}))
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