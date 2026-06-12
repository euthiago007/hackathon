import { Router } from "express";
import { EmpresaService } from "../services/empresa";


const router = Router();
const empresaService = new EmpresaService();


router.get("/", async (req, res) => {
  const empresas = await empresaService.findAll();

  res.json(empresas);
});

export default router;