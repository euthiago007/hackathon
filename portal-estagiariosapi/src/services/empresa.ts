import { pool } from "../config/database";
import { EmpresaRepository } from "../repositories/empresa";

export class EmpresaService {
  private repository = new EmpresaRepository();

  async findAll() {
    return this.repository.findAll();
  }

  async create(data: any) {
  return await this.repository.create(data);
}



async findById(id: number) {
  return await this.repository.findById(id);
}

async update(id: number, data: any) {
  return await this.repository.update(id, data);
}

async delete(id: number) {
  return await this.repository.delete(id);
}

async login(email: string, senha: string) {
  return await this.repository.login(email, senha);
}
}