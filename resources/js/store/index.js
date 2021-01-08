import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    form:{ id: '', nombre: '', apellido: '', telefono: '', email: '', direccion: ''},
    filter: '',
    clientes: [
     /*   { id: 10, nombre:'Chris 2', apellido:'Vale', telefono:'123456', email:'chvc@c1.co', direccion:'c123' },*/
      ]
  },
  mutations: {
      insertarUsuario(state, data){
        state.clientes.push(data)
      },
      obtenerClientes(state, data){
        state.clientes = []
        state.clientes = data
      },
      eliminarUsuario(state, index){
        state.clientes.splice(index, 1)
      },
      actualizarUsuario(state, [i, data]){

        state.clientes.splice(i, 1, data)
      }
  },
  actions: {

      async crearUsuario({commit}, data){
        try {
          const r = await axios.post('/api/clientes', data)
          commit('insertarUsuario', r.data.data)
          return [true, r]
        } catch (e) {
          return [false, e.response]
        }
      },

      async obtenerClientes({commit}){
        const r = await axios.get('/api/clientes')
        commit('obtenerClientes', r.data.data)
      },

      async eliminarUsuario({commit}, data){
        try {
          const r = await axios.delete('/api/clientes/'+data.id)
          const index = obtenerIndice(this.state.clientes,  data.id)
          commit('eliminarUsuario', git )
          return [true, r]
        } catch (e) {
          return [false, e.response]
        }
      },

      async actualizarUsuario({commit}, data){
        try {
          const r = await axios.put('/api/clientes/'+data.id, data)
          
          const index = obtenerIndice(this.state.clientes,  data.id)
          commit('actualizarUsuario', [index, r.data.data])

          return [true, r]
        } catch (e) {
          return [false, e.response]
        }
      },

  },
  modules: {
  }
})

function obtenerIndice(clientes, id){
  let index = null
  clientes.forEach((item, i)=>{
    if (item.id == id){
      index = i
    }
  })
  return index
}