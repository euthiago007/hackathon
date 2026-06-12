import { AlunoRepository } from "../repositories/aluno";

export class AlunoService {
  private repository = new AlunoRepository();

  async findAll() {
    return this.repository.findAll();
  }

  async create(data: any) {
    return this.repository.create(data);
  }

  async findById(id: number) {
    return await this.repository.findById(id);
  }

  async update(id: number, data: any) {
    return await this.repository.update(id, data);
  };

  async delete(id: number) {
  return await this.repository.delete(id);
  };
}

