package com.unialfa.model;

public class Empresa {

        private Long id;
        private String nome;
        private String cnpj;
        private String email;
        private StatusEmpresa status;

    public StatusEmpresa getStatus() {
        return status;
    }

    public void setStatus(StatusEmpresa status) {
        this.status = status;
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

