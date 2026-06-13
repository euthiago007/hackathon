package com.unialfa.gui;

import javax.swing.*;

import com.unialfa.dao.AlunoDAO;
import com.unialfa.model.Aluno;

public class AlunoGUI extends JFrame {

    private JTextField txtNome = new JTextField();
    private JTextField txtMatricula = new JTextField();
    private JCheckBox chkApto = new JCheckBox("Apto");

    private JButton btnSalvar = new JButton("Salvar");

    private AlunoDAO dao = new AlunoDAO();

    public AlunoGUI() {

        setTitle("Cadastro de Aluno");
        setSize(350, 250);
        setLayout(null);

        JLabel lblNome = new JLabel("Nome:");
        lblNome.setBounds(10, 10, 100, 25);
        add(lblNome);

        txtNome.setBounds(10, 35, 250, 25);
        add(txtNome);

        JLabel lblMatricula = new JLabel("Matrícula:");
        lblMatricula.setBounds(10, 70, 100, 25);
        add(lblMatricula);

        txtMatricula.setBounds(10, 95, 250, 25);
        add(txtMatricula);

        chkApto.setBounds(10, 130, 100, 25);
        add(chkApto);

        btnSalvar.setBounds(10, 165, 100, 30);
        add(btnSalvar);

        btnSalvar.addActionListener(e -> salvar());

        setDefaultCloseOperation(EXIT_ON_CLOSE);
        setVisible(true);
    }

    private void salvar() {

        Aluno a = new Aluno();

        a.setNome(txtNome.getText());
        a.setMatricula(txtMatricula.getText());
        a.setApto(chkApto.isSelected());

        dao.inserir(a);

        JOptionPane.showMessageDialog(this, "Aluno salvo!");
    }
}