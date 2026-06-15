import { pool } from "../config/database";

export class VagaRepository {

  async findAll() {
    const [rows] = await pool.query(
      "SELECT * FROM vagas"
    );

    return rows;
  }

  async create(data: any) {
    const {
  titulo,
  descricao,
  requisitos,
  bolsa,
  ativa,
  empresa_id
} = data;await pool.query(
  `INSERT INTO vagas
  (titulo, descricao, requisitos, bolsa, ativa, empresa_id)
  VALUES (?, ?, ?, ?, ?, ?)`,
  [
    titulo,
    descricao,
    requisitos,
    bolsa,
    ativa,
    empresa_id
  ]
);

return {
  message: "Vaga cadastrada com sucesso"
};

} 

async findById(id: number) {
  const [rows] = await pool.query(
    "SELECT * FROM vagas WHERE id = ?",
    [id]
  );

  return (rows as any[])[0];
}

async update(id: number, data: any) {
    const {
  titulo,
  descricao,
  requisitos,
  bolsa,
  ativa,
  empresa_id
} = data;

await pool.query(
  `UPDATE vagas
   SET titulo = ?,
       descricao = ?,
       requisitos = ?,
       bolsa = ?,
       ativa = ?,
       empresa_id = ?
   WHERE id = ?`,
  [
    titulo,
    descricao,
    requisitos,
    bolsa,
    ativa,
    empresa_id,
    id
  ]
);

return {
  message: "Vaga atualizada com sucesso"
};
}

async delete(id: number) {


  await pool.query(
    "DELETE FROM candidaturas WHERE vaga_id = ?",
    [id]
  );

  
  await pool.query(
    "DELETE FROM vagas WHERE id = ?",
    [id]
  );

  return {
    message: "Vaga removida com sucesso"
  };
}



}