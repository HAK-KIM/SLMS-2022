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
        <tr v-for:="student in students">
            <td >{{ student.id }}</td>
            <td >{{ student.name }}</td>
            <td>{{ student.email }}</td>            
            <td v-if="student.status==null" class="text-center pa-0">
                <v-actions  @click="update(student.id, true)" style="background-color: #04e;">
                    <span>Edit</span>
                </v-actions>
                <v-actions @click="update(student.id, false)"  style="background-color: #e04;" class="ml-3">
                    <span>Delete</span>
                </v-actions>
            </td>
            <td v-else></td>
        </tr>
        </tbody>
    </v-table>
</template>

<script>
    export default {
        props: ['students'],
        data() {
            return {
                headers: ['student Id', 'username', 'email', 'actions'],
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
  }
</style>