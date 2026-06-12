import { EmpresaRepository } from "../repositories/empresa";

export class EmpresaService {
  private repository = new EmpresaRepository();

  async findAll() {
    return this.repository.findAll();
  }

  
}