package com.unialfa.gui;

import com.unialfa.model.Candidatura;
import com.unialfa.service.CandidaturaService;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.util.List;

public class CandidaturaGui extends JFrame {

    private JTable tabela;
    private DefaultTableModel model;
    private CandidaturaService service = new CandidaturaService();

    public CandidaturaGui() {

        setTitle("Gestão de Candidaturas");
        setSize(700, 400);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        setLocationRelativeTo(null);

        model = new DefaultTableModel(
                new Object[]{"ID", "Aluno", "Vaga", "Status"}, 0
        );

        tabela = new JTable(model);

        add(new JScrollPane(tabela));

        carregar();
    }

    private void carregar() {
        try {
            List<Candidatura> lista = service.listar();

            model.setRowCount(0);

            for (Candidatura c : lista) {
                model.addRow(new Object[]{
                        c.getId(),
                        c.getAlunoId(),
                        c.getVagaId(),
                        c.getStatus()
                });
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}