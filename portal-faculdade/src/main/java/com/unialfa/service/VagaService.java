package com.unialfa.service;

import com.unialfa.dao.VagaDao;
import com.unialfa.model.Vaga;

import java.sql.SQLException;
import java.util.List;

public class VagaService {

    private final VagaDao dao = new VagaDao();

    public List<Vaga> listar() throws SQLException {
        return dao.listar();
    }
}