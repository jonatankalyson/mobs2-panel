<template>
  <div class="login">
    <div class="login-container">
      <h1>Login</h1>
      <form @submit.prevent="login">
        <input v-model="email" placeholder="Email" type="email" />
        <input v-model="password" placeholder="Senha" type="password" />
        <button type="submit">Entrar</button>
      </form>
      <p class="register-link">
        Não tem conta?
        <button @click="goToRegister" class="register-button">Criar Conta</button>
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth'

const email = ref('')
const password = ref('')
const auth = useAuthStore()
const router = useRouter()

async function login() {
  try {
    const response = await auth.login(email.value, password.value)
    console.log(response)
    router.push('/vehicles')
  } catch (e) {
    alert('Erro ao logar', e)
  }
  
}
function goToRegister() {
  router.push('/register')
}
</script>

<style scoped>
/* Estilo global do container de login */
.login {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(135deg, #6a11cb, #2575fc);
  font-family: 'Arial', sans-serif;
}

/* Container central do formulário */
.login-container {
  background: white;
  padding: 2.5rem 3rem;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
  width: 100%;
  max-width: 400px;
  text-align: center;
}

/* Título do login */
.login-container h1 {
  margin-bottom: 1.5rem;
  color: #333;
  font-size: 2rem;
}

/* Inputs do formulário */
.login-container input {
  width: 100%;
  padding: 0.75rem 1rem;
  margin-bottom: 1rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s ease;
}

/* Efeito ao focar nos inputs */
.login-container input:focus {
  outline: none;
  border-color: #2575fc;
  box-shadow: 0 0 8px rgba(37, 117, 252, 0.3);
}

/* Botão de login */
.login-container button {
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

.login-container button:hover {
  background: #6a11cb;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsividade */
@media (max-width: 480px) {
  .login-container {
    padding: 2rem 1.5rem;
  }
  .login-container h1 {
    font-size: 1.5rem;
  }
}
</style>
