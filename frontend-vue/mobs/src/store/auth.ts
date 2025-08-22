import { defineStore } from "pinia";
import api, { setAuthToken } from "@/services/api";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    token: localStorage.getItem("token") || "",
    user: null as null | { id: number; name: string; email: string },
  }),
  actions: {
    async login(email: string, password: string) {
      const res = await api.post("/login", { email, password });
      this.token = res.data.token;
      localStorage.setItem("token", this.token);
      setAuthToken(this.token);
    },
    async logout() {
      this.token = "";
      localStorage.removeItem("token");
    },
  },
});
