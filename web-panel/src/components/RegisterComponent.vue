<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <b-form>
        <b-form-group label=" Name:" >
          <b-form-input
              v-model="form.name"
              required
          ></b-form-input>
          <b-form-group label=" Email Address:" >
            <b-form-input
                v-model="form.email"
                required
                type="email"
            ></b-form-input>
          </b-form-group>
          <b-form-group label=" Password:" >
            <b-form-input
                v-model="form.password"
                required
                type="password"
            ></b-form-input>
          </b-form-group>
          <b-form-group label=" Confirm Password:" >
            <b-form-input
                v-model="form.repass"
                required
                type="password"
            ></b-form-input>
          </b-form-group>
        </b-form-group>
        <b-button type="submit" @click="save" variant="primary">Register</b-button>
        <router-link variant="danger" to="/" tag="button">Cancel</router-link>
      </b-form>
    </div>
    <div v-else>
      <h4>Submitted Successfully!</h4>
      <button class="btn btn-success" @click="continueRegister"> Add Another Account</button>
    </div>
  </div>
</template>

<script>
import DataService from "../services/DataService";

export default {
  name: "RegisterComponent",
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        repass: '',
      },
      submitted: false
    }
  },
  methods: {
    save() {
      let data = {
        name: this.form.name,
        email: this.form.email,
        password: this.form.password,
        repass: this.form.repass,
      };

      DataService.create(data)
          .then(response => {
            this.form.name = response.data.name;
            console.log(response.data);
            this.submitted = true;
          })
          .catch(e => {
            console.log(e);
          });
    },

    continueRegister() {
      this.submitted = false;
      this.data = {};
    }
  }
}
</script>
<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>
