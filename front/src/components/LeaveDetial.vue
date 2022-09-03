<template>
  <v-table
    class="rounded-lg mt-4"
    style="
      box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px,
        rgba(0, 0, 0, 0.23) 0px 6px 6px;
    "
  >
    <thead>
      <tr style="background-color: #04e">
        <th
          v-for:="item in items"
          class="text-left text-white font-weight-medium"
          style="font-size: 16px"
        >
          {{ item }}
        </th>
      </tr>
    </thead>
    <tbody>
      <p
        v-if="leaves.length == 0"
        width="100%"
        class="text-center text-error text-h6 pa-5"
      >
        No leave found
      </p>
      <tr v-for:="item in leaves">
        <td>{{ item.leave_type }}</td>
        <td>{{item.date_start}}</td>
        <td>{{item.end_date}}</td>        
        <td>
          {{ item.duration }} <span v-if="item.duration > 1">Days</span
          ><span v-else>Day</span>
        </td>
        <td width="300px">{{ item.reason }}</td>
        <td>
          <span v-if="item.status == true" class="text-primary">Approved</span>
          <span v-else-if="item.status == false" class="text-error"
            >Rejected</span
          >
          <span v-else-if="item.status == null" class="text-warning">New</span>
        </td>
        
      </tr>
    </tbody>
  </v-table>
</template>

<script>
export default {
  props: ["items", "leaves"],
};
</script>

<style scoped>
td:nth-of-type(even) {
  background-color: rgba(0, 0, 0, 0.13);
}

v-actions {
  cursor: pointer;
  padding: 5px 15px;
  border-radius: 10px;
  color: #fff;
}

img {
  width: 45px;
  height: 45px;
  border-radius: 50%;
}

v-actions {
  cursor: pointer;
  padding: 5px 15px;
  border-radius: 10px;
  color: #fff;
}

p {
  text-align: center;
  padding: 2%;
}
</style>
