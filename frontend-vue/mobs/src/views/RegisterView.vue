<template>
  <div class="register">
    <h1>Criar Conta</h1>
    <form @submit.prevent="register">
      <input v-model="name" placeholder="Nome completo" type="text" required />
      <input v-model="email" placeholder="Email" type="email" required />
      <input v-model="password" placeholder="Senha" type="password" required />
      <input v-model="passwordConfirmation" placeholder="Confirmar senha" type="password" required />
      
      <button type="submit" :disabled="isLoading">
        {{ isLoading ? 'Criando conta...' : 'Criar conta' }}
      </button>
      
      <div v-if="error" class="error-message">
        {{ error }}
      </div>
    </form>
    
    <p class="login-link">
      Já tem conta? <router-link to="/login">Faça login aqui</router-link>
    </p>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/services/api'

const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')
const isLoading = ref(false)
const error = ref('')
const router = useRouter()

async function register() {
  isLoading.value = true
  error.value = ''
  
  if (password.value !== passwordConfirmation.value) {
    error.value = 'As senhas não coincidem'
    isLoading.value = false
    return
  }
  
  try {
    console.log('teste')
    const response = await api.post('/register', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: passwordConfirmation.value
    })
    console.log(response)
    
    if (response.status == 201) {
      alert('Conta criada com sucesso! Faça login.')
      router.push('/login')
    }
  } catch (e) {
    console.error('Registration error:', e)
    error.value = e.response?.data?.message || 'Erro ao criar conta'
  } finally {
    isLoading.value = false
  }
}
</script>

<style scoped>
.register {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 2rem;
  background: linear-gradient(135deg, #6a11cb, #2575fc);
  font-family: 'Arial', sans-serif;
}

.register h1 {
  color: white;
  font-size: 2rem;
  margin-bottom: 1.5rem;
}

form {
  background: white;
  padding: 2rem 2.5rem;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
  width: 100%;
  max-width: 400px;
  display: flex;
  flex-direction: column;
}

input {
  width: 100%;
  padding: 0.75rem 1rem;
  margin-bottom: 1rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s ease;
}

input:focus {
  outline: none;
  border-color: #2575fc;
  box-shadow: 0 0 8px rgba(37, 117, 252, 0.3);
}

button {
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
}

button:hover:not(:disabled) {
  background: #6a11cb;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

button:disabled {
  background: #ccc;
  cursor: not-allowed;
}

.error-message {
  color: #ff4d4f;
  margin: 0.5rem 0 1rem;
  padding: 0.5rem;
  border: 1px solid #ff4d4f;
  border-radius: 8px;
  text-align: center;
  font-size: 0.9rem;
}

.login-link {
  margin-top: 1.5rem;
  text-align: center;
  color: white;
}

.login-link a {
  color: #ffd700;
  font-weight: bold;
  text-decoration: none;
  transition: all 0.3s ease;
}

.login-link a:hover {
  text-decoration: underline;
}

/* Responsividade */
@media (max-width: 480px) {
  form {
    padding: 1.5rem 1.5rem;
  }

  .register h1 {
    font-size: 1.5rem;
  }
}
</style>
