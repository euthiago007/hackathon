package com.unialfa.gui;

import com.unialfa.model.Vaga;
import com.unialfa.service.VagaService;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.util.List;

public class VagaGui extends JFrame {

    private JTable tabela;
    private DefaultTableModel model;
    private VagaService service = new VagaService();

    public VagaGui() {

        setTitle("Gestão de Vagas");
        setSize(700, 400);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        setLocationRelativeTo(null);

        model = new DefaultTableModel(
                new Object[]{"ID", "Título", "Bolsa", "Ativa"}, 0
        );

        tabela = new JTable(model);

        add(new JScrollPane(tabela));

        carregar();
    }

    private void carregar() {
        try {
            List<Vaga> vagas = service.listar();

            model.setRowCount(0);

            for (Vaga v : vagas) {
                model.addRow(new Object[]{
                        v.getId(),
                        v.getTitulo(),
                        v.getBolsa(),
                        v.getAtiva()
                });
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}