import { pool } from "../config/database";

export class VagaRepository {

  async findAll() {
    const [rows] = await pool.query(
      "SELECT * FROM vagas"
    );

    return rows;
  }

} 