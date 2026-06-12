import { VagaRepository } from "../repositories/vaga";

export class VagaService {
  private repository = new VagaRepository();

  async findAll() {
    return this.repository.findAll();
  }
}