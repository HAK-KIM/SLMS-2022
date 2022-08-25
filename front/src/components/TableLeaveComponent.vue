<template>
 <v-alert
    v-model="alert"
    density="comfortable"
    type="success"
    variant="tonal"
    closable
    border="start"
    class="mb-3"
  >
      Leave request have been <strong v-if="status==true">approved</strong> <strong v-else-if="status==false">rejected</strong> successfully.
  </v-alert>

  <v-table
    class="rounded mx-auto elevation-6"
  >
    <thead>
      <tr style="background-color: #04e;">
        <th v-for:="item in items" class="text-left text-h6 text-white">{{item}}</th>
      </tr>
    </thead>
    <tbody>
      <p v-if="leaves.length==0" width="100%" class="text-center text-error text-h6 pa-5">No leave found</p>
      <tr v-for:="item in leaves">
        <td >{{ item.leave_type }}</td>
        <td>{{ item.date_start }}</td>
        <td>{{ item.end_date }}</td>
        <td> 
          <span v-if="item.status==true" class="text-primary">Approved</span> 
            <span v-else-if="item.status==false" class="text-error">Rejected</span> 
            <span v-else-if="item.status==null" class="text-warning">New</span> 
        </td>
        <td>{{ item.reason }}</td>
        <td>{{item.duration }} <span v-if="item.duration>1">Days</span><span v-else>Day</span></td>
        <td v-if="item.status==null" class="text-center pa-0">
        <v-actions  @click="update(item.id, true)" style="background-color: #04e;">
          <span>Approve</span>
        </v-actions>
        <v-actions @click="update(item.id, false)"  style="background-color: #e04;" class="ml-3">
            <span>Reject</span>
        </v-actions>
        </td>
        <td v-else></td>
      </tr>
    </tbody>
  </v-table>
</template>

<script>
import Swal from 'sweetalert2'
  export default {
    props: ['leaves'],
    emits: ['update'],
    data() {
      return {
        items: ['Type Leave', 'From', 'To', 'Status', 'Reason', 'Duration', 'Action'],
        alert: false,
        status: false
      }
    },
    methods: {
      update(id, status) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: status ? 'Yes, I approve' : 'Yes, I reject'
          }).then((result) => {
            if (result.isConfirmed) {
              this.$emit('update', id, status);
              this.alert = true;
              if (status) {
                this.status = true;
              }
            }
          })
      },
    }
  }
</script>

<style scoped>
  td:nth-of-type(odd){
    background-color: rgba(0, 0, 0, 0.130);
  }
  v-actions {
    cursor: pointer;
    padding: 5px 15px;
    border-radius:10px;
    color: #fff;
  }
</style>