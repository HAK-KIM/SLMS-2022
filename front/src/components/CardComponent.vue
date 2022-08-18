<template>
    <section class="pa-3">
        <v-card
          max-width="600"
          style="
          border-radius: 9px;
          box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;"
          :class = "{blue: leave.status, red: !leave.status, gray: leave.status==null}"
          class="mx-auto"
        >
            <v-card-content 
                class="d-flex justify-space-between"
            >
                <v-card-content>
                    <v-card-title>
                        {{leave.leave_type}}
                    </v-card-title>
                    <v-card-text>
                        Duration: 3 days
                    </v-card-text>
                </v-card-content>
            <v-card-actions v-if="leave.status == null">
                <v-icon @click="update(true, leave.id)" style="cursor: pointer; font-size: 32px" color="success">{{'mdi-checkbox-marked'}}</v-icon>
                <v-icon @click="update(false, leave.id)" style="cursor: pointer; font-size: 32px" color="red">{{'mdi-close-box'}}</v-icon>
            </v-card-actions>
            </v-card-content>
            <v-card-actions class="pa-0">
                <v-spacer></v-spacer>
                <v-btn
                    icon
                    @click="show = !show"
                >
                <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                </v-btn>
            </v-card-actions>
            <v-expand-transition>
                <div v-show="show">
                    <v-divider></v-divider>
                    <v-card-text>
                        From: 
                        {{leave.date_start}}
                        {{leave.start_time}}
                        to: 
                        {{leave.end_date}}
                        {{leave.end_time}}
                    </v-card-text>
                    <v-card-text>
                        Reason: 
                        {{leave.reason}}
                    </v-card-text>
                </div>
            </v-expand-transition>
        </v-card>
    </section>
</template>

<script>
    export default {
        data: () => ({
            show: false,
        }),
        props: ['leave'],
        emits: ['update'],
        methods: {
            update(status, id) {
                this.$emit('update', status, id)
            }
        }
    }
</script>

<style scoped>
    .blue {
        border: 1px solid #04f;
        border-left: 7px solid #04f;
    }
    .red {
        border: 1px solid #f04;
        border-left: 7px solid #f04;
    }
    .gray {
        border: 1px solid #567;
        border-left: 7px solid #567;
    }
</style>
