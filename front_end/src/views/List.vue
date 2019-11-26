<template>
  <div class="login">
    <div class>
      <div class="col-md-6 offset-md-3">
        <h2 class="display-4 text-center mt-5">list Form</h2>

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

}
</script>

<style>

</style>