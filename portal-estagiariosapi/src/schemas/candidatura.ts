import { z } from "zod";

export const candidaturaSchema = z.object({
  aluno_id: z.number(),
  vaga_id: z.number(),
  status: z.enum([
    "PENDENTE",
    "EM_ANALISE",
    "APROVADA",
    "REJEITADA"
  ])
});