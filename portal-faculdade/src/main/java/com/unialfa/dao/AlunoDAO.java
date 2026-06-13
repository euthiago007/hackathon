package com.unialfa.dao;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import com.unialfa.model.Aluno;
import com.unialfa.util.Conexao;

public class AlunoDAO {

    public void inserir(Aluno a) {

        System.out.println("Entrou no DAO");

        String sql = "INSERT INTO alunos (aluno_id, vaga_id, status) VALUES (?, ?, ?)";

        try (Connection conn = Conexao.conectar();
             PreparedStatement stmt = conn.prepareStatement(sql)) {

            stmt.setInt(1, a.getAlunoId());
            stmt.setInt(2, a.getVagaId());
            stmt.setString(3, a.getStatus());

            stmt.executeUpdate();

            System.out.println("INSERT executado com sucesso!");

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public List<Aluno> listar() {

        List<Aluno> lista = new ArrayList<>();

        String sql = "SELECT * FROM alunos";

        try (Connection conn = Conexao.conectar();
             PreparedStatement stmt = conn.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {

            while (rs.next()) {

                Aluno a = new Aluno();

                a.setId(rs.getInt("id"));
                a.setAlunoId(rs.getInt("aluno_id"));
                a.setVagaId(rs.getInt("vaga_id"));
                a.setStatus(rs.getString("status"));
                a.setCreatedAt(rs.getString("created_at"));

                lista.add(a);
            }

        } catch (Exception e) {
            e.printStackTrace();
        }

        return lista;
    }
}
