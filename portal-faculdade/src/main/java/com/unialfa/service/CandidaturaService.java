package com.unialfa.service;

import com.unialfa.dao.CandidaturaDAO;
import com.unialfa.model.Candidatura;

import java.sql.SQLException;
import java.util.List;

public class CandidaturaService {

    private final CandidaturaDAO dao = new CandidaturaDAO();

    public List<Candidatura> listar() throws SQLException {
        return dao.listar();
    }
}