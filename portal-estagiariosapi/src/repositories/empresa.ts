import { pool } from "../config/database";


export class EmpresaRepository {
  async findAll() {
    const [rows] = await pool.query(
        "SELECT * FROM empresas"
    )
    return rows;
 };

 async create(data: any) {
   const { nome, cnpj, email, telefone, status } = data;
 await pool.query(
  `INSERT INTO empresas
  (nome, cnpj, email, telefone, status)
  VALUES (?, ?, ?, ?, ?)`,
  [nome, cnpj, email, telefone, status]
);


 }
async findById(id: number) {
    const [rows] = await pool.query(
  "SELECT * FROM empresas WHERE id = ?",
  [id]

  
);      
return (rows as any[])[0];

}

async update(id: number, data: any) {
    const { nome, cnpj, email, telefone, status } = data;   
    await pool.query(
  `UPDATE empresas
   SET nome = ?,
       cnpj = ?,
       email = ?,
       telefone = ?,
       status = ?
   WHERE id = ?`,
  [nome, cnpj, email, telefone, status, id]
);
 return {
  message: "Empresa atualizada com sucesso"
};

}

async delete(id: number) {
  await pool.query(
    "DELETE FROM empresas WHERE id = ?",
    [id]
  );

  return {
    message: "Empresa removida com sucesso"
  };
}

async login(email: string, senha: string) {
  const [rows] = await pool.query(
    `SELECT * FROM empresas
     WHERE email = ?
     AND senha = ?`,
    [email, senha]
  );

  return (rows as any[])[0];
};
}