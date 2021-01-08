<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-row>
        <b-col>
          <input type="hidden" v-model="form.id" />
          <b-form-group
            id="input-group-1"
            label="Nombres:"
            label-for="nombre"
            description="Escribe aqui el nombre completo"
          >
            <b-form-input
              id="nombre"
              v-model="form.nombre"
              type="text"
              placeholder="Ejemplo: Carlos"
              required
            >
            </b-form-input>
          </b-form-group>
        </b-col>

        <b-col>
          <b-form-group
            id="input-group-2"
            label="Apellidos:"
            label-for="apellido"
            description="Escribe aqui tus apellidos"
          >
            <b-form-input
              id="apellido"
              v-model="form.apellido"
              type="text"
              placeholder="Ejemplo: Valencia Cuero"
              required
            >
            </b-form-input>
          </b-form-group>
        </b-col>
      </b-row>

      <b-form-group id="input-group-3" label="Telefono:" label-for="telefono">
        <b-form-input
          id="telefono"
          v-model="form.telefono"
          type="number"
          placeholder="Ejemplo: 3104445555"
        >
        </b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-4"
        label="Correo electrónico:"
        label-for="email"
      >
        <b-form-input
          :readonly="form.id != ''"
          id="email"
          v-model="form.email"
          type="email"
          placeholder="Ejemplo: chris@c123.co"
          required
        >
        </b-form-input>
      </b-form-group>

      <b-form-group id="input-group-5" label="Dirección:" label-for="direccion">
        <b-form-input
          id="direccion"
          v-model="form.direccion"
          type="text"
          placeholder="Ejemplo: Calle falsa 123"
          required
        >
        </b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">
        {{ enviando ? "Espere..." : form.id ? "Actualizar" : "Enviar" }}
      </b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </div>
</template>


<script>
import { mapActions, mapState } from "vuex";
import { cloneDeep } from "lodash";
export default {
  name: "Form",
  data() {
    return {
      enviando: false,
      show:true
    };
  },
  computed: {
    ...mapState(["form"]),
  },
  methods: {
    ...mapActions(["crearUsuario", "actualizarUsuario"]),
    
    async onSubmit(e) {
      e.preventDefault();
      this.enviando = true;
      let res;
      if (!this.form.id) {
        res = await this.crearUsuario(this.form);
      } else {
        res = await this.actualizarUsuario(this.form);
      }
      this.enviando = false;
      if (res[0] === true) {
        this.makeToast(
          false,
          "Exitoso",
          "Usuario " +
            (this.form.id ? "actualizado" : "creado") +
            " de manera exitosa"
        )
        this.$store.state.form = formEmpty()
      } else {
        let msg = "";
        Object.entries(res[1].data.errors)?.forEach((obj) => {
          msg += obj[1][0] + " ";
        });
        this.makeToast(false, "Error", msg);
      }
    },

      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.$store.state.form = formEmpty()
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      },

    makeToast(append = false, title, msg) {
      this.$bvToast.toast(msg, {
        title: title,
        autoHideDelay: 5000,
        appendToast: append,
      });
    },
  },
};

function formEmpty(){
  return {
          id: "",
          nombre: "",
          apellido: "",
          telefono: "",
          email: "",
          direccion: "",
        }
}
</script>