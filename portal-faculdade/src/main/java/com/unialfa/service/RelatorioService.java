package com.unialfa.service;

import com.unialfa.dao.*;
import com.unialfa.model.*;

import java.io.File;
import java.io.FileWriter;
import java.util.List;

public class RelatorioService {

    private EmpresaDao empresaDao = new EmpresaDao();
    private VagaDao vagaDao = new VagaDao();
    private CandidaturaDAO candidaturaDAO = new CandidaturaDAO();

    public void relatorioEmpresas() {
        gerarRelatorio("relatorio_empresas.txt", writer -> {
            List<Empresa> empresas = empresaDao.listar();

            StringBuilder console = new StringBuilder();

            console.append("\n===== RELATÓRIO EMPRESAS =====\n");

            writer.write("===== RELATÓRIO EMPRESAS =====\n");

            for (Empresa e : empresas) {

                String linha =
                        "ID: " + e.getId() +
                                " | Nome: " + e.getNome() +
                                " | CNPJ: " + e.getCnpj() +
                                " | Status: " + e.getStatus() + "\n";

                writer.write(linha);
                console.append(linha);
            }

            console.append("=============================\n");

            System.out.println(console);
        });
    }

    public void relatorioVagas() {
        gerarRelatorio("relatorio_vagas.txt", writer -> {
            List<Vaga> vagas = vagaDao.listar();

            StringBuilder console = new StringBuilder();

            console.append("\n===== RELATÓRIO VAGAS =====\n");

            writer.write("===== RELATÓRIO VAGAS =====\n");

            writer.write("=== VAGAS ===\n");
            for (Vaga v : vagas) {
                String linha =
                        "ID: " + v.getId() +
                                " | Título: " + v.getTitulo() +
                                " | Bolsa: " + v.getBolsa() +
                                " | Ativa: " + v.getAtiva() + "\n";

                writer.write(linha);
                console.append(linha);
            }

            console.append("==========================\n");

            System.out.println(console);
        });
    }

    public void relatorioCandidaturas() {
        gerarRelatorio("relatorio_candidaturas.txt", writer -> {
            List<Candidatura> lista = candidaturaDAO.listar();

            StringBuilder console = new StringBuilder();

            console.append("\n===== RELATÓRIO CANDIDATURAS =====\n");

            writer.write("===== RELATÓRIO CANDIDATURAS =====\n");

            for (Candidatura c : lista) {

                String linha =
                        "Aluno ID: " + c.getAlunoId() +
                                " | Vaga ID: " + c.getVagaId() +
                                " | Status: " + c.getStatus() + "\n";

                writer.write(linha);
                console.append(linha);
            }

            console.append("=================================\n");

            System.out.println(console);
        });
    }

    private interface Escritor {
        void escrever(FileWriter writer) throws Exception;
    }

    private void gerarRelatorio(String nomeArquivo, Escritor bloco) {

        try  {

            File pasta = new File("Relatorios");
            if (!pasta.exists()) {
                pasta.mkdir();
            }

            File arquivo = new File(pasta, nomeArquivo);

            try (FileWriter writer = new FileWriter(arquivo)) {

                bloco.escrever(writer);

                System.out.println("Relatório salvo em: " + arquivo.getAbsolutePath());
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}



