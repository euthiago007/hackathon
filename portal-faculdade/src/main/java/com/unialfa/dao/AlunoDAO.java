package com.unialfa.dao;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import com.unialfa.model.Aluno;
import com.unialfa.util.Conexao;

public class AlunoDAO {

    public void inserir(Aluno a) {

        System.out.println("Entrou no DAO");
        String sql = "INSERT INTO alunos (nome, matricula, apto) VALUES (?, ?, ?)";

        try (Connection conn = Conexao.conectar();
             PreparedStatement stmt = conn.prepareStatement(sql)) {

            stmt.setString(1, a.getNome());
            stmt.setString(2, a.getMatricula());
            stmt.setBoolean(3, a.isApto());

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
                a.setNome(rs.getString("nome"));
                a.setMatricula(rs.getString("matricula"));
                a.setApto(rs.getBoolean("apto"));

                lista.add(a);
            }

        } catch (Exception e) {
            e.printStackTrace();
        }

        return lista;
    }
}
