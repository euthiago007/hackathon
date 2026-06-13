import { Router } from "express";
import { CandidaturaService } from "../services/candidatura";
import { candidaturaSchema } from "../schemas/candidatura";

const router = Router();
const candidaturaService = new CandidaturaService();

router.get("/", async (req, res) => {
  const candidaturas = await candidaturaService.findAll();

  res.json(candidaturas);
});


router.post("/", async (req, res) => {
  const data = candidaturaSchema.parse(req.body);

  const candidatura = await candidaturaService.create(data);

  res.status(201).json(candidatura);
});

router.get("/:id", async (req, res) => {
  const id = Number(req.params.id);

  const candidatura = await candidaturaService.findById(id);

  res.json(candidatura);
});

router.put("/:id", async (req, res) => {
  const id = Number(req.params.id);

  const data = req.body;

  const resultado = await candidaturaService.update(id, data);

  res.json(resultado);
}); 

router.delete("/:id", async (req, res) => {
  const id = Number(req.params.id);

  const resultado = await candidaturaService.delete(id);

  res.json(resultado);
});
export default router;