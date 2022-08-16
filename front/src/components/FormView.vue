<template>
  <v-card class="pa-6" 
  style="width:600px; 
  box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
  border-top: 5px solid #04e;
  border-radius: 10px;
  ">
    <v-card-title class="text-center">
      <span class="text-h4">Create Request</span>
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col
            cols="12"
            sm="12"
            md="12"
          >
            <v-select
              :items="['Sick', 'Go to home town', 'family event']"
              label="Leaves Type *"
            ></v-select>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <label for="">Start Date</label>
            <input type="date" placeholder="Start from" class="date" v-model="startDate"/>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <label for="">Time</label>
            <v-select
              v-model="items[0]"
              :items="['Afternoon', 'Morning']"
            ></v-select>
          </v-col>  
          <v-col
            cols="12"
            sm="6"
          >
            <label for="">End Date</label>
            <input type="date" placeholder="Start from" class="date" v-model="startDate"/>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <label for="">Time</label>
            <v-select
              v-model="items[0]"
              :items="['Afternoon', 'Morning']"
            ></v-select>
          </v-col>  
                    <v-col
            cols="12"
            md="12"
            sm="12"
          >
          <span for="">Duration: <span>3</span> days</span>
          </v-col>
          <v-col
            cols="12"
            md="12"
            sm="12"
          >
            <v-textarea
              label="Reason"
            ></v-textarea>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
    <v-card-actions class="ml-6">
      <v-btn
        style="background-color: #f40"
        color="#fff"
        text
      >
        Cancel
      </v-btn>
      <v-btn
        style="background-color: #04f"
        color="#fff"
        text
      >
        Request
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
      startDate: "",
      items:['Afternoon', 'Morning']
    }),
  }
</script>

<style scoped>
  .date {
    width: 100%;
    outline: none;
    padding: 16px;
    background-color: #eee;
    border-bottom: 1px solid #999;
    font-size: 16px;
    color: #000;
    border-radius: 3px 3px 0 0;
    font-weight: 300;
  }
</style>