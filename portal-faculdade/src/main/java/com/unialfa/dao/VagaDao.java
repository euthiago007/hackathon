package com.unialfa.dao;

import com.unialfa.model.Vaga;
import com.unialfa.util.Conexao;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class VagaDao {

    public List<Vaga> listar() throws SQLException {

        List<Vaga> vagas = new ArrayList<>();

        String sql = "SELECT * FROM vagas";

        try (Connection conn = Conexao.conectar();
             PreparedStatement stmt = conn.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {

            while (rs.next()) {

                Vaga v = new Vaga();

                v.setId(rs.getLong("id"));
                v.setTitulo(rs.getString("titulo"));
                v.setDescricao(rs.getString("descricao"));
                v.setRequisitos(rs.getString("requisitos"));
                v.setBolsa(rs.getDouble("bolsa"));
                v.setAtiva(rs.getBoolean("ativa"));
                v.setEmpresaId(rs.getLong("empresa_id"));

                vagas.add(v);
            }
        }

        return vagas;
    }
}