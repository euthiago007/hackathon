import { Router } from "express";
import { VagaService } from "../services/vaga";
import { vagaSchema } from "../schemas/vaga";

const router = Router();
const vagaService = new VagaService();

router.get("/", async (req, res) => {
  const vagas = await vagaService.findAll();

  res.json(vagas);
});

router.post("/", async (req, res) => {
  const data = vagaSchema.parse(req.body);

  const vaga = await vagaService.create(data);

  res.status(201).json(vaga);
});

router.get("/:id", async (req, res) => {
  const id = Number(req.params.id);

  const vaga = await vagaService.findById(id);

  res.json(vaga);
});

router.put("/:id", async (req, res) => {
  const id = Number(req.params.id);

  const data = req.body;

  const resultado = await vagaService.update(id, data);

  res.json(resultado);
});

router.delete("/:id", async (req, res) => {
  const id = Number(req.params.id);

  const resultado = await vagaService.delete(id);

  res.json(resultado);
});
export default router;