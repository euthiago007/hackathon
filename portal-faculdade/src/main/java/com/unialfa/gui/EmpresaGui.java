package com.unialfa.gui;

import com.unialfa.model.Empresa;
import com.unialfa.model.StatusEmpresa;
import com.unialfa.service.EmpresaService;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.util.List;

public class EmpresaGui extends JFrame {

    private JTable tabela;
    private DefaultTableModel model;

    private EmpresaService service = new EmpresaService();

    public EmpresaGui() {
        setTitle("Gestão de Empresas");
        setSize(700, 400);
        setLocationRelativeTo(null);

        model = new DefaultTableModel(
                new Object[]{"ID", "Nome", "CNPJ", "Email", "Status"}, 0
        );

        tabela = new JTable(model);

        add(new JScrollPane(tabela), BorderLayout.CENTER);

        JPanel panel = new JPanel();

        JButton btnAprovar = new JButton("Aprovar");
        JButton btnBloquear = new JButton("Bloquear");

        panel.add(btnAprovar);
        panel.add(btnBloquear);

        add(panel, BorderLayout.SOUTH);


        btnAprovar.addActionListener(e -> alterar(StatusEmpresa.APROVADA));
        btnBloquear.addActionListener(e -> alterar(StatusEmpresa.BLOQUEADA));

        carregar();
    }

    private void carregar() {
        try {
            model.setRowCount(0);

            List<Empresa> lista = service.getDao().listar();

            for (Empresa e : lista) {
                model.addRow(new Object[]{
                        e.getId(),
                        e.getNome(),
                        e.getCnpj(),
                        e.getEmail(),
                        e.getStatus()
                });
            }

        } catch (Exception e) {
            JOptionPane.showMessageDialog(this, "Erro: " + e.getMessage());
        }
    }

    private void alterar(StatusEmpresa status) {
        try {
            int row = tabela.getSelectedRow();

            if (row == -1) {
                JOptionPane.showMessageDialog(this, "Selecione uma empresa!");
                return;
            }

            Long id = (Long) model.getValueAt(row, 0);

            if (status == StatusEmpresa.APROVADA) {
                service.aprovar(id);
            } else {
                service.bloquear(id);
            }

            carregar();

        } catch (Exception e) {
            JOptionPane.showMessageDialog(this, "Erro: " + e.getMessage());
        }
    }
}