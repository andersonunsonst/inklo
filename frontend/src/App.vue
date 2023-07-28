<script setup>
 import {api, perfils, backend} from './services/config';
 import { ref, reactive, onMounted, computed} from 'vue';

 const users = reactive([]);
 const getUsers = ()=>{
  perfils.forEach((perfil)=>{
    api.get(perfil)
    .then((res) => (users.push(res.data)))
    .catch(error =>console.log(error));
  });

 }


const search = ref('');

const searchedUsers = computed(() => {
      return users.filter((item) => {
        return (
          item.name
            .toLowerCase()
            .indexOf(search.value.toLowerCase()) != -1
        );
      });
});

async function saveInfo(login){
  backend.post('http://localhost:8000/api/salvar-local', {login:login})
   .then(response =>{
     alert(response.data);
    console.log(response.data);
  });
 }


 onMounted(()=>{
  getUsers()
 });
</script>

<template>
 
    <div class="container" >
        <div class="row">
          <div class="col s12">
            <input type="text" placeholder="Busca" v-model="search" >
            <label for="first_name">Buscar</label>
          </div>
        </div>
        <div class="row">
            <div class="col l4 s4 m4" v-for="user in searchedUsers" :key="user.id" >
              <div class="card" >
                
                  <div class="card-image">
                    <img :src="user.avatar_url" >
                    <span class="card-title">{{ user.name }}</span>
                  </div>
                  <div class="card-content">
                    <p>Usuário desde {{ new Date(user.created_at).toLocaleString('pt-br')}}</p>
                    <p> Repositórios: {{ user.public_repos }}</p>
                  </div>
                  <div class="card-action">
                    <a target="blank" :href="user.html_url">Visite o Repositório</a>
                  
                    
                    
                  </div>
                
              </div>
              <button class="waves-effect waves-light btn" @click="saveInfo(user.login)">Salvar Informações Localmente</button>
            </div>
        </div>

       
    </div>
 
</template>