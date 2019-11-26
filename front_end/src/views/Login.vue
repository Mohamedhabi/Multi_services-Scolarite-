<template>
  <div class="login">
    <div class>
      <div class="col-md-4 offset-md-4">
        <h2 class="display-4 text-center mt-5">Login Form admin</h2>

        <form action="#">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" v-model="email" class="form-control" />
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              v-model="password"
              class="form-control"
            />
            <div style="color:red;" v-if="error">{{ error }}</div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-info btn-block" @click.prevent="performLogin">Login</button>
          </div>
        </form>
        <circle-spin v-show="isLoading"></circle-spin>
      </div>
    </div>
  </div>
</template>

<script>

export default {
    name:"login",
    data() {
        return {
        email: "",
        password: "",
        error: "",
        isLoading: false,
        res:""
        };
    },
    methods: {
      performLogin() {
      this.isLoading = true;
      this.$store
        .dispatch("performLoginAction", {
          email: this.email,
          password: this.password
        })
        .then(res => {
          this.res=res;
          this.isLoading = false;
          this.$router.push("/Students");
        })
        .catch(err => {
          this.isLoading = false;
          if(err.response && err.response.status==401) this.error = err.response.data.message;
          else this.error ="You are not connected to the server";
          console.log(err);
        });
      }
    }
}
</script>

<style>

</style>