package com.unialfa.gui;

import com.unialfa.dao.AlunoDAO;
import com.unialfa.model.Aluno;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.util.List;

public class ListarAlunoGUI extends JFrame {

    private JTable tabela;
    private DefaultTableModel modelo;

    private JButton btnAtualizar = new JButton("Atualizar");
    private JButton btnEditar = new JButton("Editar");

    private AlunoDAO dao = new AlunoDAO();

    public ListarAlunoGUI() {

        setTitle("Lista de Alunos");
        setSize(800, 400);
        setLayout(null);
        setLocationRelativeTo(null);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);


        modelo = new DefaultTableModel();

        modelo.addColumn("ID");
        modelo.addColumn("Nome");
        modelo.addColumn("Email");
        modelo.addColumn("RA");
        modelo.addColumn("Curso");
        modelo.addColumn("Apto");

        tabela = new JTable(modelo);

        JScrollPane scroll = new JScrollPane(tabela);
        scroll.setBounds(10, 10, 760, 280);

        add(scroll);

        btnAtualizar.setBounds(10, 310, 120, 30);
        add(btnAtualizar);

        btnEditar.setBounds(150, 310, 120, 30);
        add(btnEditar);

        btnAtualizar.addActionListener(e -> carregarAlunos());

        btnEditar.addActionListener(e -> editarAluno());

        carregarAlunos();

        setVisible(true);
    }

    private void carregarAlunos() {

        modelo.setRowCount(0);

        List<Aluno> alunos = dao.listar();

        for (Aluno a : alunos) {

            modelo.addRow(new Object[]{
                    a.getId(),
                    a.getNome(),
                    a.getEmail(),
                    a.getMatricula(),
                    a.getCurso(),
                    a.isApto()
            });
        }
    }

    private void editarAluno() {

        int linha = tabela.getSelectedRow();

        if (linha == -1) {

            JOptionPane.showMessageDialog(this,
                    "Selecione um aluno.");

            return;
        }

        int id = (Integer) tabela.getValueAt(linha, 0);

        new EditarAlunoGUI(id);
    }
}
