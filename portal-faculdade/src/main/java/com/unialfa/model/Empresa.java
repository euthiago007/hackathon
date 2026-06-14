package com.unialfa.model;

public class Empresa {

        private Long id;
        private String nome;
        private String cnpj;
        private String telefone;
        private String email;
        private String senha;
        private StatusEmpresa status;

    public StatusEmpresa getStatus() {
        return status;
    }

    public void setStatus(StatusEmpresa status) {
        this.status = status;
    }

    public String getSenha() {
        return senha;
    }

    public void setSenha(String senha) {
        this.senha = senha;
    }

    public String getTelefone() {
        return telefone;
    }

    public void setTelefone(String telefone) {
        this.telefone = telefone;
    }

    public String getEmail() {
            return email;
        }

        public void setEmail(String email) {
            this.email = email;
        }

        public String getCnpj() {
            return cnpj;
        }

        public void setCnpj(String cnpj) {
            this.cnpj = cnpj;
        }

        public String getNome() {
            return nome;
        }

        public void setNome(String nome) {
            this.nome = nome;
        }

        public Long getId() {
            return id;
        }

        public void setId(Long id) {
            this.id = id;
        }


        public Empresa() {
        }

        public Empresa(String nome, String cnpj, String email) {
            this.nome = nome;
            this.cnpj = cnpj;
            this.email = email;
        }
    }

