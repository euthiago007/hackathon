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
}