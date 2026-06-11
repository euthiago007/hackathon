import express from "express";
import cors from "cors";

import alunoRoutes from "./routes/aluno";

const app = express();

app.use(cors());
app.use(express.json());


app.use("/aluno", alunoRoutes);

export default app;