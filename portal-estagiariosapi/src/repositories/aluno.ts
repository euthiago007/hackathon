import { pool } from "../config/database";

export class AlunoRepository {
  async findAll() {
    const [rows] = await pool.query(
      "SELECT * FROM alunos"
    );

    return rows;
  }

  async create(data: any) {
    const { nome, email, matricula, curso } = data;

    const [result]: any = await pool.query(
      `
      INSERT INTO alunos
      (nome, email, matricula, curso)
      VALUES (?, ?, ?, ?)
      `,
      [nome, email, matricula, curso]
    );

    return result;
  }

  async findById(id: number) {
  const [rows]: any = await pool.query(
    "SELECT * FROM alunos WHERE id = ?",
    [id]
  );

  return rows[0];
}

async update(id: number, data: any) {
  const {nome, email, matricula, curso} = data;
 await pool.query(
  `UPDATE alunos
     SET nome = ?,
         email = ?,
         matricula = ?,
         curso = ?
     WHERE id = ?`,
  [nome, email, matricula, curso, id]
 
  );
  return {
    message: "Aluno atualizado com sucesso"
  }
 
}

}