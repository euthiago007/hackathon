package com.unialfa.dao;

import com.unialfa.model.Aluno;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.util.ArrayList;
import java.util.List;

public class AlunoDAO extends Dao {

    public void inserir(Aluno a) {

        String sql =
                "INSERT INTO alunos (nome, email, matricula, curso, apto_estagio) VALUES (?, ?, ?, ?, ?)";

        try (Connection conn = getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {

            stmt.setString(1, a.getNome());
            stmt.setString(2, a.getEmail());
            stmt.setString(3, a.getMatricula());
            stmt.setString(4, a.getCurso());
            stmt.setBoolean(5, a.isApto());

            stmt.executeUpdate();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public List<Aluno> listar() {

        List<Aluno> lista = new ArrayList<>();

        try {

            ResultSet resultSet = getConnection()
                    .prepareStatement("SELECT * FROM alunos")
                    .executeQuery();

            while (resultSet.next()) {

                Aluno a = new Aluno();

                a.setId(resultSet.getInt("id"));
                a.setNome(resultSet.getString("nome"));
                a.setEmail(resultSet.getString("email"));
                a.setMatricula(resultSet.getString("matricula"));
                a.setCurso(resultSet.getString("curso"));
                a.setApto(resultSet.getBoolean("apto_estagio"));

                lista.add(a);
            }

        } catch (Exception e) {
            e.printStackTrace();
        }

        return lista;
    }
}