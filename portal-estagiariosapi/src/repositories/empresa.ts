import { pool } from "../config/database";


export class EmpresaRepository {
  async findAll() {
    const [rows] = await pool.query(
        "SELECT * FROM empresas"
    )
    return rows;
 };

 
}