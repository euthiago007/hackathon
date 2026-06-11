import { AlunoRepository } from "../repositories/aluno";

export class AlunoService {
  private repository = new AlunoRepository();

  async findAll() {
    return this.repository.findAll();
  }

  async create(data: any) {
    return this.repository.create(data);
  }
}