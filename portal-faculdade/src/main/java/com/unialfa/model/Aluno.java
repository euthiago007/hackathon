package com.unialfa.model;

public class Aluno {

    private int id;
    private String nome;
    private String email;
    private String matricula;
    private String curso;
    private boolean apto;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getMatricula() {
        return matricula;
    }

    public void setMatricula(String matricula) {
        this.matricula = matricula;
    }

    public String getCurso() { return curso; }
    public void setCurso(String curso) { this.curso = curso; }

    public boolean isApto() {
        return apto;
    }

    public void setApto(boolean apto) {
        this.apto = apto;
    }
}