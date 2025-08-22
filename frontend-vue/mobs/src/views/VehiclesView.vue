<template>
  <div class="vehicles-page">
    <div class="header">
      <h1>Veículos</h1>
      <button class="add-button" @click="goToForm">Adicionar Veículo</button>
    </div>

    <button class="fetch-button" @click="fetchVehicles">Carregar Veículos</button>

    <ul class="vehicles-list">
      <li v-for="v in vehicles" :key="v.id" class="vehicle-item">
        {{ v.placa }} - {{ v.modelo }} ({{ v.fabricante }} - {{ v.ano }})
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "@/services/api";

const vehicles = ref<any[]>([]);
const router = useRouter();

async function fetchVehicles() {
  const res = await api.get(`/vehicles`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem("token")}`,
    },
  });
  vehicles.value = res.data;
}

function goToForm() {
  router.push('/form'); // ou a rota correta do seu form
}
</script>

<style scoped>
.vehicles-page {
  max-width: 800px;
  margin: 0 auto;
  padding: 2rem;
  font-family: 'Arial', sans-serif;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 1rem;
}

h1 {
  color: #2575fc;
}

li{
text-color:black;
}

.add-button, .fetch-button {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 8px;
  background: #2575fc;
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
  margin: 0.5rem 0;
}

.add-button:hover, .fetch-button:hover {
  background: #6a11cb;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.vehicles-list {
  list-style: none;
  padding: 0;
  margin-top: 1rem;
}

.vehicle-item {
  padding: 0.75rem 1rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  margin-bottom: 0.5rem;
  background: #f9f9f9;
  transition: all 0.2s ease;
  color: #333; 
}

.vehicle-item:hover {
  background: #e6f0ff;
  border-color: #2575fc;
  color: #333; 
}

/* Responsividade */
@media (max-width: 480px) {
  .header {
    flex-direction: column;
    align-items: flex-start;
  }
  .add-button {
    width: 100%;
  }
}
</style>
