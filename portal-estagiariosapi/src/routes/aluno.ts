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

router.get("/:id", async( req, res ) =>{
 const id = (req.params.id); 

 const aluno = await alunoService.findById(Number(id));

 if(!aluno) {
  return res.status(404).json({
     message: "Aluno não encontrado" 
    });
 }

 res.json(aluno);

})

router.put("/:id", async(req, res) => {
  const id = Number(req.params.id);

  const data = req.body; 

  const aluno = await alunoService.update(id, data);
  
  res.json(aluno);
});

export default router;