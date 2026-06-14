import { z } from "zod";

export const empresaSchema = z.object({
  nome: z.string(),
  cnpj: z.string(),
  email: z.email(),
  telefone: z.string(),
  status: z.string(),
  senha: z.string()
});