<template>
  <div class="vehicle-form">
    <!-- ... header ... -->
    
    <form @submit.prevent="submitForm" class="form-container">
      <!-- ... mensagens ... -->

      <div class="form-grid">
        <div class="form-column">
          <div class="form-group">
            <label for="placa">Placa *</label>
            <input
              id="placa"
              v-model="vehicle.placa"
              type="text"
              placeholder="ABC-1234"
              required
              :class="{ error: errors.placa }"
            >
            <span class="error-text" v-if="errors.placa">{{ errors.placa[0] }}</span>
          </div>

          <div class="form-group">
            <label for="modelo">Modelo *</label>
            <input
              id="modelo"
              v-model="vehicle.modelo"
              type="text"
              placeholder="Ex: Civic, Corolla, etc."
              required
              :class="{ error: errors.modelo }"
            >
            <span class="error-text" v-if="errors.modelo">{{ errors.modelo[0] }}</span>
          </div>
        </div>

        <div class="form-column">
          <div class="form-group">
            <label for="fabricante">Fabricante *</label>
            <input
              id="fabricante"
              v-model="vehicle.fabricante"
              type="text"
              placeholder="Ex: Honda, Toyota, etc."
              required
              :class="{ error: errors.fabricante }"
            >
            <span class="error-text" v-if="errors.fabricante">{{ errors.fabricante[0] }}</span>
          </div>

          <div class="form-group">
            <label for="ano">Ano *</label>
            <input
              id="ano"
              v-model="vehicle.ano"
              type="number"
              min="1900"
              :max="new Date().getFullYear() + 1"
              placeholder="2024"
              required
              :class="{ error: errors.ano }"
            >
            <span class="error-text" v-if="errors.ano">{{ errors.ano[0] }}</span>
          </div>
        </div>
      </div>

       <button type="submit">Entrar</button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '@/services/api'

const route = useRoute()
const router = useRouter()

const loading = ref(false)
const editing = ref(false)
const message = ref('')
const messageType = ref('')

// Ajuste para os nomes corretos que o backend espera
const vehicle = reactive({
  placa: '',
  modelo: '',
  fabricante: '',
  ano: new Date().getFullYear()
})

async function submitForm() {
 console.log('Dados do formulário:', vehicle)
  try {
    const response = await api.post('/vehicles', vehicle, {
  headers: {
    Authorization: `Bearer ${localStorage.getItem('token')}`, // se estiver guardando o token no localStorage
    Accept: 'application/json'
  }
})
    const tokenuser = response.data.user_id
    localStorage.setItem("user_id", tokenuser);
    console.log(response)
    router.push('/vehicles')
  } catch (e) {
    alert('Erro ao registra', e)
  }
}

const errors = reactive<Record<string, string[]>>({})

// ... resto do código mantido igual ...
</script>

<style scoped>
.vehicle-form {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 2rem;
  background: linear-gradient(135deg, #6a11cb, #2575fc);
  min-height: 100vh;
  font-family: 'Arial', sans-serif;
}

.form-container {
  background: white;
  padding: 2rem 2.5rem;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
  width: 100%;
  max-width: 600px;
}

.form-container h2 {
  text-align: center;
  margin-bottom: 1.5rem;
  color: #333;
}

.form-grid {
  display: flex;
  gap: 2rem;
  flex-wrap: wrap;
}

.form-column {
  flex: 1;
  min-width: 250px;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 1rem;
}

.form-group label {
  margin-bottom: 0.5rem;
  font-weight: bold;
  color: #333;
}

.form-group input {
  padding: 0.75rem 1rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.form-group input:focus {
  outline: none;
  border-color: #2575fc;
  box-shadow: 0 0 8px rgba(37, 117, 252, 0.3);
}

.error {
  border-color: #ff4d4f;
}

.error-text {
  color: #ff4d4f;
  font-size: 0.875rem;
  margin-top: 0.25rem;
}

button[type="submit"] {
  width: 100%;
  padding: 0.75rem 1rem;
  border: none;
  border-radius: 8px;
  background: #2575fc;
  color: white;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-top: 1rem;
}

button[type="submit"]:hover {
  background: #6a11cb;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsividade */
@media (max-width: 768px) {
  .form-grid {
    flex-direction: column;
  }
}
</style>
