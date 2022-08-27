<template>
  <v-row justify="center">
    <v-btn
        color="primary"
        @click="dialog=true"
    >
        Open Dialog
    </v-btn>
    <v-dialog
      v-model="dialog"
      fullscreen
    >
      <v-card>
        <v-toolbar
            color="#04e"
        >
          <v-btn
            @click="dialog = false"
            color="#fff"
          >
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title class="text-white">Student Detial</v-toolbar-title>
        </v-toolbar>
        <v-list>
            <studentInfo />
        </v-list>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import studentInfo from '../components/StudentInformation.vue'
  export default {
    components: {
        studentInfo,
    },
    data () {
      return {
        dialog: false,
        notifications: false,
        sound: true,
        widgets: false,
      }
    },
  }
</script>