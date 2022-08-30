<template>
    <v-card class="col-6 mx-auto text-center my-3 pa-3 d-flex justify-space-between" elevation="6">
            <v-img width="350" height="350" src="https://thumbs.dreamstime.com/b/cute-cat-portrait-square-photo-beautiful-white-closeup-105311158.jpg" />
        <v-table width="50%" class="mx-6" elevation="9" max-width="500px">
            <tbody>
                <tr class="text-left" v-for:="(value,key) in student">
                    <td class="text-capitalize font-weight-medium" v-if="key != 'leaves' && key != 'id' ">{{key}}</td>
                    <td class="text-capitalize" v-if="key != 'leaves' && key != 'id'" max-width="300px">{{value}}</td>
                </tr>
            </tbody>
        </v-table>
    </v-card>
    
</template>

<script>
    export default {
        props: ['student'],
        data() {
            return {
                image: "https://thumbs.dreamstime.com/b/cute-cat-portrait-square-photo-beautiful-white-closeup-105311158.jpg",
                items: ['Type Leave', 'From', 'To', 'Status', 'Reason', 'Duration'],
            }
        }
    }
</script>

<style scoped>
    v-table {
        box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
    }
    tr:nth-of-type(even){
        background-color: rgba(0, 0, 0, 0.130);
    }
</style>