package com.unialfa.dao;

import com.unialfa.model.Candidatura;
import com.unialfa.model.StatusCandidatura;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CandidaturaDAO extends Dao {

    public void inserir(Candidatura c) {

        String sql =
                "INSERT INTO candidaturas (aluno_id, vaga_id, status, created_at) VALUES (?, ?, ?, ?)";

        try {

            PreparedStatement stmt =
                    getConnection().prepareStatement(sql);

            stmt.setInt(1, c.getAlunoId());
            stmt.setInt(2, c.getVagaId());
            stmt.setString(3, c.getStatus().name());
            stmt.setString(4, c.getCreatedAt());

            stmt.executeUpdate();

            stmt.close();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public List<Candidatura> listar() {

        List<Candidatura> lista = new ArrayList<>();

        try {

            PreparedStatement stmt =
                    getConnection().prepareStatement(
                            "SELECT * FROM candidaturas"
                    );

            ResultSet rs = stmt.executeQuery();

            while (rs.next()) {

                Candidatura c = new Candidatura();

                c.setId(rs.getInt("id"));
                c.setAlunoId(rs.getInt("aluno_id"));
                c.setVagaId(rs.getInt("vaga_id"));
                c.setStatus(
                        StatusCandidatura.valueOf(
                                rs.getString("status")
                        )
                );
                c.setCreatedAt(rs.getString("created_at"));

                lista.add(c);
            }

            rs.close();
            stmt.close();

        } catch (Exception e) {
            e.printStackTrace();
        }

        return lista;
    }
}