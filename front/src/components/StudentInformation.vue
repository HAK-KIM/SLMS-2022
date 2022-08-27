<template>
    <div class="info-detail">
        <div class="name-defualt">
        <div>FIRST NAME</div>
        <div class="getinfo"><strong>{{ user.firstName }}</strong></div>
        </div>
    </div>

    <div class="info-detail">
        <div class="name-defualt">
        <div>LAST NAME</div>
        <div class="getinfo"><strong>{{user.lastName}}</strong></div>
        </div>
    </div>
    <!-- CLASS INFO -->
    <div class="info-detail">
        <div class="name-defualt">
        <div>ClASS</div>
        <div class="getinfo"><strong>{{user.class}}</strong></div>
        </div>
    </div>
    <!-- GENDER INFO-->
    <div class="info-detail">
        <div class="name-defualt">
        <div>GENDER</div>
        <div class="getinfo"><strong>{{user.gender}}</strong></div>
        </div>
    </div>
    <!-- BATCH GENERATION -->
    <div class="info-detail">
        <div class="name-defualt">
        <div>BATCH</div>
        <div class="getinfo"><strong>{{user.batch}}</strong></div>
        </div>
    </div>
    <!-- STUDENT ID -->
    <div class="info-detail">
        <div class="name-defualt">
        <div>STUDENT ID</div>
        <div class="getinfo"><strong>{{user.personal_id}}</strong></div>
        </div>
    </div>
    <!-- PHONE NUMBER-->
    <div class="info-detail">
        <div class="name-defualt">
        <div>CONTACT</div>
        <div class="getinfo"><strong>{{user.phone}}</strong></div>
        </div>
    </div>
    <!-- EMAIL -->
    <div class="info-detail">
        <div class="name-defualt">
        <div>EMAIL</div>
        <div class="getinfo"><strong style="color: blue;">{{user.email}}</strong></div>
        </div>
    </div>
</template>