package com.unialfa.dao;

import com.unialfa.model.Vaga;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class VagaDao extends Dao {

    public List<Vaga> listar() throws SQLException {

        List<Vaga> vagas = new ArrayList<>();

        PreparedStatement stmt =
                getConnection().prepareStatement("SELECT * FROM vagas");

        ResultSet rs = stmt.executeQuery();

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

        rs.close();
        stmt.close();

        return vagas;
    }
}