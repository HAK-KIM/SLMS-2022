<template>
<v-alert
    prominent
    type="info"
    variant="tonal"
    border="start"
    border-color="info"
    class="mt-3 mx-auto"
    max-width="800"
    style="cursor: pointer;"
    >
        <div class=" d-flex justify-space-between align-center">
            <strong style="color: #000;" class="d-flex align-center justify-space-between">
                <v-img class="rounded-circle mr-2" width="45" src="https://cdn.vox-cdn.com/thumbor/yzPdGsXFWCHbNMlDWHhPROUzVeI=/1400x1400/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/8378039/baby-groot-guardians.0.jpg"></v-img>
                Khan Vibol
            </strong>
            <span style="color: #000;">{{leave.leave_type}}</span>
            <span style="color: #000;">{{leave.created_at}}</span>
            <v-icon color="#f04" style="cursor: pointer;">{{'mdi-delete'}}</v-icon>
        </div>
        
    </v-alert>
</template>

<script>
    export default {
        props: ['leave']
    }
</script>