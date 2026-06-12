import { Router } from "express";
import { VagaService } from "../services/vaga";

const router = Router();
const vagaService = new VagaService();

router.get("/", async (req, res) => {
  const vagas = await vagaService.findAll();

  res.json(vagas);
});

export default router;