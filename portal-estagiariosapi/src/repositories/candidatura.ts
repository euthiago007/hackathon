import { pool } from "../config/database";

export class CandidaturaRepository {

    async findAll() {
  const [rows] = await pool.query(
    "SELECT * FROM candidaturas"
  );

  return rows;
}

async create(data: any) {
    const {
  aluno_id,
  vaga_id,
  status
} = data;
await pool.query(
  `INSERT INTO candidaturas
  (aluno_id, vaga_id, status)
  VALUES (?, ?, ?)`,
  [
    aluno_id,
    vaga_id,
    status
  ]
);
return {
  message: "Candidatura realizada com sucesso"
};

}   

async findById(id: number) {
  const [rows] = await pool.query(
    "SELECT * FROM candidaturas WHERE id = ?",
    [id]
  );

  return (rows as any[])[0];
}

async update(id: number, data: any) {
  const {
    aluno_id,
    vaga_id,
    status
  } = data;

  await pool.query(
    `UPDATE candidaturas
     SET aluno_id = ?,
         vaga_id = ?,
         status = ?
     WHERE id = ?`,
    [
      aluno_id,
      vaga_id,
      status,
      id
    ]
  );

  return {
    message: "Candidatura atualizada com sucesso"
  };
}

async delete(id: number) {
  await pool.query(
    "DELETE FROM candidaturas WHERE id = ?",
    [id]
  );

  return {
    message: "Candidatura removida com sucesso"
  };
}
}