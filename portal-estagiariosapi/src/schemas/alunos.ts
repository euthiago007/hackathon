import { z } from "zod";

export const createAlunoSchema = z.object({
  nome: z.string().min(3),
  email: z.email(),
  matricula: z.string().min(3),
  curso: z.string().min(2),
});