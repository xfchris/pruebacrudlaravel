<template>
  <div>
    <h2>Clientes</h2>
    <b-table
      :items="clientes"
      :fields="fields"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :filter="filter"
      responsive="sm"
      bordered
      striped
      hover
      show-empty
      small>
      <!-- A virtual column -->
      <template #cell(Acciones)="data">
        <div class="d-flex align-items-center justify-content-center">
          <b-button  size="sm" variant="light" @click="actualizar(data.item)">
            <b-icon icon="pencil-square" font-scale="1"></b-icon>
          </b-button>
          <b-button  size="sm" variant="light" @click="eliminarUsuario(data.item)">
            <b-icon icon="x-circle-fill" font-scale="1"></b-icon>
          </b-button>
        </div>        
      </template>
    
    </b-table>

  </div>
</template>


<script>
  import { mapState, mapMutations, mapActions } from 'vuex'

  export default {
    name: "Tabla",
    data() {
      return {
        sortBy: 'age',
        sortDesc: false,
        fields: [
          { key: 'nombre', label: 'Nombres', sortable: true },
          { key: 'apellido', label: 'Apellidos', sortable: true },
          { key: 'telefono', label: 'Teléfono', sortable: true },
          { key: 'email', label: 'Correo', sortable: true },
          { key: 'direccion', label: 'Dirección', sortable: true },
          'Acciones'

        ]
      }
    },
    computed:{
      ...mapState(['clientes', 'filter'])
    },
    methods:{
      ...mapActions(['obtenerClientes', 'eliminarUsuario']),
      actualizar(data){
        this.$store.state.form = _.cloneDeep(data);
      }
    },
    mounted(){
      this.obtenerClientes()
    }
  }
</script>