import { z } from "zod";

export const vagaSchema = z.object({
  titulo: z.string(),
  descricao: z.string(),
  requisitos: z.string(),
  bolsa: z.number(),
  ativa: z.boolean(),
  empresa_id: z.number()
});