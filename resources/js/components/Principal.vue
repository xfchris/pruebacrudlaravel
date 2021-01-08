<template>
  <div>
    <div>
      <b-navbar toggleable="sm" type="dark" variant="info">
        <b-navbar-brand href="#">Crud Vue</b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-item href="/">Principal</b-nav-item>
          </b-navbar-nav>

          <!-- Right aligned nav items -->
          <b-navbar-nav class="ml-auto">
            <b-nav-form>
              <b-form-input
                size="sm"
                class="mr-sm-2"
                placeholder="Search"
                v-model="$store.state.filter"
              ></b-form-input>
            </b-nav-form>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </div>

    <b-container fluid>
      <b-container fluid class="mt-3">
        <b-row>
          <b-col cols="12" sm="4" class="mt-3">
            <Form />
          </b-col>
          <b-col>
            <Tabla />
          </b-col>
        </b-row>
      </b-container>
    </b-container>
  </div>
</template>

<script>
import { mapState } from "vuex";
import Form from "./Form";

import Tabla from "./Tabla";
export default {
  name: "Principal",
  components: {
    Form,
    Tabla,
  },
};
</script>