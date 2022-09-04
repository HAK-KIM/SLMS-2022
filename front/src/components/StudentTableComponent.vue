
<template>
    <v-row>
        <v-col cols="6" sm="3" class="mt-4">
            <v-select class="text-white" :items="batches" label="Select By Batches" variant="solo" v-model="batch">
            </v-select>
        </v-col>
        <v-col cols="6" sm="9" class="mt-4">
            <v-text-field variant="solo" class="text-white" label="Search" prepend-inner-icon="mdi-magnify" v-model="filterName">
            </v-text-field>
        </v-col>
    </v-row>
    <v-table class="rounded mx-auto elevation-6">
        <thead>
            <tr style="background-color: #04e; width: 100%">
                <th v-for:="item in headers" class="text-left text-white text-uppercase" style="font-size: 16px;">
                    {{ item }}</th>
                </tr>
            </thead>
            <tbody>
            <p class="text-h6 text-error pa-3" v-if="filterData.length == 0">No students!</p>
            <v-dialog v-model="dialog" persistent hide-overlay transition="dialog-bottom-transition">
                <v-card>
                    <v-toolbar color="#04e" class="text-white">
                        <v-toolbar-title>Student Detail</v-toolbar-title>
                        <v-icon @click="dialog = false" class="mr-4">mdi-close</v-icon>
                    </v-toolbar>
                    <v-list class="px-4">
                        <studentInfo :student='student' elevation="6" />
                        <leave class=" rounded" elevation="6" :items='items' :leaves='leaves' />
                    </v-list>
                </v-card>
            </v-dialog>
            <tr v-for:="(student, index) in filterData" style="cursor:pointer; font-size: 18px; ">
                <td @click="getLeaveAndStudent(student.id)" class="py-1">
                    <v-img style="border: 1px solid #04e;" width="50px" height="50px" class="rounded-circle"
                        :src="student.image != null ? student.image : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'">
                    </v-img>
                </td>
                <td @click="getLeaveAndStudent(student.id)" style="font-size: 16px;">{{ student.firstName }}</td>
                <td @click="getLeaveAndStudent(student.id)" style="font-size: 16px;">{{ student.lastName }}</td>
                <td @click="getLeaveAndStudent(student.id)" style="font-size: 16px;">{{ student.gender }}</td>
                <td @click="getLeaveAndStudent(student.id)" style="font-size: 16px;">{{ student.batch }}</td>
                <td class="d-flex pa-4" style="height: 60px">
                    <modal :type="false" :student="student" :id="student.id" @update='updateStudent' />
                    <v-actions @click="deleteStudent(student.id)" style="background-color: #e04;" class="ml-1">
                        Delete
                    </v-actions>
                </td>
            </tr>
        </tbody>
    </v-table>
</template>

<script>
import modal from '../components/FormCreateStudent.vue'
import leave from '../components/LeaveDetial.vue';
import studentInfo from '../components/StudentInformation.vue';
import Swal from 'sweetalert2'
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
            items: ['Type Leave', 'From', 'To', 'Duration', 'Reason', 'Status'],
            headers: ['profile', 'firstname', 'lastname', 'gender', 'batch', 'action'],
            batches: ['All', '2022', '2023'],
            leaves: [],
            student: {},
            batch: 'All',
            filterName: '',
        }
    },

    computed: {
        filterData() {
            let items = this.students;
            if (this.batch != "All") {
                items = this.students.filter(student => (student.batch.toLowerCase() == this.batch.toLowerCase()));
            } if (this.filterName != "") {
                items = this.students.filter(student => ((student.firstName.toLowerCase().includes(this.filterName.toLowerCase()))||(student.lastName.toLowerCase().includes(this.filterName.toLowerCase()))));
            }
            return items;
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
            this.$emit('update', id, body);
        },
        getLeaveAndStudent(id) {
            this.dialog = true;
            for (let student of this.students) {
                if (id == student.id) {
                    this.leaves = student.leaves;
                    this.student = student;
                }
            }
        },
    }
}
</script>

<style scoped>
v-actions {
    cursor: pointer;
    padding: 5px 15px;
    border-radius: 10px;
    color: #fff;
    display: flex;
    align-items: center;
}
</style>