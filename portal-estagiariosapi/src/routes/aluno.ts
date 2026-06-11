import { Router } from "express";
import { AlunoService } from "../services/aluno";
import { createAlunoSchema } from "../schemas/alunos";

const router = Router();

const alunoService = new AlunoService();

router.get("/", async (req, res) => {
  const alunos = await alunoService.findAll();

  res.json(alunos);
});

router.post("/", async (req, res) => {
  const dados = createAlunoSchema.parse(req.body);

  const aluno = await alunoService.create(dados);

  res.status(201).json(aluno);
});

export default router;