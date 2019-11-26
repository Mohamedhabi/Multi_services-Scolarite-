<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <router-link class="navbar-brand" to="/">Home</router-link>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item" v-if="!(loggedIn ||StudentloggedIn)">
          <router-link class="nav-link my-1 ml-1" to="/Login">Login</router-link>
        </li>
        <li class="nav-item" v-if="!(loggedIn ||StudentloggedIn)">
          <router-link class="nav-link my-1 ml-1" to="/Student/Login">Login as a student</router-link>
        </li>
        <li class="nav-item" v-if="loggedIn">
          <router-link class="nav-link my-1 ml-1" to="/Students">Students</router-link>
        </li>
        <li class="nav-item" v-if="loggedIn">
          <router-link class="nav-link my-1 ml-1" to="/Add">Add</router-link>
        </li>
        <li class="nav-item" v-if="StudentloggedIn">
          <router-link class="nav-link my-1 ml-1" to="/Student/Profile">Profile</router-link>
        </li>
        <li class="nav-item" v-if="loggedIn">
          <button class="nav-link my-1 ml-1" @click.prevent="performLogout">Logout</button>
        </li>
        <li class="nav-item" v-if="StudentloggedIn">
          <button class="nav-link my-1 ml-1" @click.prevent="performStudentLogout">Logout</button>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      token: null,
      res:""
    };
  },
  mounted() {
    this.checkUserStatus();
  },
  computed: {
    loggedIn() {
      return this.$store.getters.get_loggedIn;
    },
    StudentloggedIn() {
      return this.$store.getters.get_StudentloggedIn;
    },
  },
  methods: {
    checkUserStatus() {
      if (localStorage.getItem("token") != null) {
        this.token = localStorage.getItem("token");
      }
    },
    performLogout() {
      this.$store
        .dispatch("performLogoutAction")
        .then(res => {
          this.res=res
          this.$router.push("/Login");
        })
        .catch(err => {
          console.log(err);
          alert("You are not connected to the server");
          this.$router.push("/Login");
        });
    },
    performStudentLogout() {
        this.$store.commit("SET_StudentloggedIn", false);
        this.$store.commit("SET_Student", null);
        this.$router.push("/Student/Login");
    }
  }
};
</script>