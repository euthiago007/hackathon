package com.unialfa.service;

import com.unialfa.dao.EmpresaDao;
import com.unialfa.model.StatusEmpresa;

public class EmpresaService {

    private EmpresaDao dao = new EmpresaDao();

    public void aprovar(Long id) {
        try {
            dao.atualizarStatus(id, StatusEmpresa.APROVADA);
        } catch (Exception e) {
            throw new RuntimeException(e.getMessage());
        }
    }

    public void bloquear(Long id) {
        try {
            dao.atualizarStatus(id, StatusEmpresa.BLOQUEADA);
        } catch (Exception e) {
            throw new RuntimeException(e.getMessage());
        }
    }

    public EmpresaDao getDao() {
        return dao;
    }
}