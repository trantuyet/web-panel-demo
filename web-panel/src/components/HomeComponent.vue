<template>
  <div>
    <div>
      <b-navbar type="dark" variant="dark">
        <b-nav-item href="#">Admin Dashboard</b-nav-item>

        <b-nav-item-dropdown text="User Management" right>
          <b-dropdown-item>
            <router-link to="/">All Users</router-link>
          </b-dropdown-item>
          <b-dropdown-item href="/create">
            <router-link to="/create">Create New User</router-link>
          </b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar>
    </div>
    <div>
      <b-table striped hover :items="items" :fields="fields">

        <template #cell(actions)="row">
          <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
            Edit
          </b-button>
          <b-button size="sm" @click="row.toggleDetails">
            Delete
          </b-button>
        </template>

      </b-table>
    </div>
  </div>
</template>

<script>
// import DataService from "../services/DataService";
import axios from "axios";

export default {
  name: 'Home',
  data() {
    return {
      fields: ['id', 'email', 'name', 'actions'],
      items: [
        {
        }
      ],

    }
  },
  mounted() {
    const _this = this
    axios.get('http://127.0.0.1:8000/api/user/').then((resp) => {
      _this.items = resp.data
      _this.table++;
    })
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
