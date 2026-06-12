import { Router } from "express";
import { EmpresaService } from "../services/empresa";
import { empresaSchema } from "../schemas/empresa";


const router = Router();
const empresaService = new EmpresaService();


router.get("/", async (req, res) => {
  const empresas = await empresaService.findAll();

  res.json(empresas);
});

router.post("/", async (req, res) => {
  const data = empresaSchema.parse(req.body);

  const empresa = await empresaService.create(data);

  res.status(201).json(empresa);
});

router.get("/:id", async (req, res) => {
  const id = Number(req.params.id);

  const empresa = await empresaService.findById(id);

  res.json(empresa);
});

router.put("/:id", async (req, res) => {
  const id = Number(req.params.id);

  const data = req.body;

  const resultado = await empresaService.update(id, data);

  res.json(resultado);
});

router.delete("/:id", async (req, res) => {
  const id = Number(req.params.id);

  const resultado = await empresaService.delete(id);

  res.json(resultado);
});

export default router;