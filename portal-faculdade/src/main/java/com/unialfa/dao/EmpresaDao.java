package com.unialfa.dao;

import com.unialfa.model.Empresa;
import com.unialfa.model.StatusEmpresa;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class EmpresaDao extends Dao {


    public List<Empresa> listar() throws SQLException {
        List<Empresa> empresas = new ArrayList<>();

        ResultSet resultSet = getConnection()
                .prepareStatement("select * from empresas")
                .executeQuery();


        while (resultSet.next()) {
            Empresa e = new Empresa();

            e.setId(resultSet.getLong("id"));
            e.setNome(resultSet.getString("nome"));
            e.setCnpj(resultSet.getString("cnpj"));
            e.setEmail(resultSet.getString("email"));
            e.setStatus(StatusEmpresa.valueOf(resultSet.getString("status")));

            empresas.add(e);
        }

        return empresas;
    }


    public void atualizarStatus(Long id, StatusEmpresa status) throws SQLException {
        String sql = "UPDATE empresas SET status=? WHERE id=?";

        java.sql.PreparedStatement ps = getConnection().prepareStatement(sql);

        ps.setString(1, status.name()); // enum → String
        ps.setLong(2, id);

        ps.execute();
    }
}