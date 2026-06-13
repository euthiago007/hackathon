package com.unialfa.model;

public class Aluno {

    private int id;
    private int alunoId;
    private int vagaId;
    private String status;
    private String createdAt;

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public int getAlunoId() { return alunoId; }
    public void setAlunoId(int alunoId) { this.alunoId = alunoId; }

    public int getVagaId() { return vagaId; }
    public void setVagaId(int vagaId) { this.vagaId = vagaId; }

    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }

    public String getCreatedAt() { return createdAt; }
    public void setCreatedAt(String createdAt) { this.createdAt = createdAt; }
}