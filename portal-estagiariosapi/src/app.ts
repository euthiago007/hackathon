import express from "express";
import cors from "cors";
import empresaRoutes from "./routes/empresa";
import alunoRoutes from "./routes/aluno";

const app = express();

app.use(cors());
app.use(express.json());
app.use("/empresa", empresaRoutes);


app.use("/aluno", alunoRoutes);

export default app;