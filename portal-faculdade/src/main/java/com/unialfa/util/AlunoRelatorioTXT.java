package com.unialfa.util;


import com.unialfa.dao.AlunoDAO;
import com.unialfa.model.Aluno;

import java.io.FileWriter;
import java.io.PrintWriter;
import java.util.List;


public class AlunoRelatorioTXT {

    private AlunoDAO dao = new AlunoDAO();

    public void gerarRelatorio() {

        List<Aluno> alunos = dao.listar();

        try (PrintWriter writer = new PrintWriter(new FileWriter("relatorio_alunos.txt"))) {

            writer.println("=== RELATÓRIO DE ALUNOS ===");
            writer.println();

            for (Aluno a : alunos) {
                writer.println("ID: " + a.getId());
                writer.println("Nome: " + a.getNome());
                writer.println("Matrícula: " + a.getMatricula());
                writer.println("Apto: " + (a.isApto() ? "Sim" : "Não"));
                writer.println("------------------------");
            }
            System.out.println("Relatório gerado com sucesso!");

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}