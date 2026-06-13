package com.unialfa.gui;

import javax.swing.*;

import com.unialfa.dao.AlunoDAO;
import com.unialfa.model.Aluno;

public class AlunoGUI extends JFrame {

    private JTextField txtNome = new JTextField();
    private JTextField txtEmail = new JTextField();
    private JTextField txtMatricula = new JTextField();
    private JTextField txtCurso = new JTextField();
    private JCheckBox chkApto = new JCheckBox("Apto");

    private JButton btnSalvar = new JButton("Salvar");

    private AlunoDAO dao = new AlunoDAO();

    public AlunoGUI() {

        setTitle("Cadastro de Aluno");
        setSize(420, 460);
        setLayout(null);

// ===== Nome =====
        JLabel lblNome = new JLabel("Nome:");
        lblNome.setBounds(10, 10, 100, 25);
        add(lblNome);

        txtNome.setBounds(10, 35, 380, 30);
        add(txtNome);

// ===== Matrícula =====
        JLabel lblMatricula = new JLabel("Matrícula (RA - apenas números):");
        lblMatricula.setBounds(10, 70, 250, 25);
        add(lblMatricula);

        txtMatricula.setBounds(10, 95, 380, 30);
        add(txtMatricula);

// trava numérica
        txtMatricula.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyTyped(java.awt.event.KeyEvent e) {
                char c = e.getKeyChar();
                if (!Character.isDigit(c)) {
                    e.consume();
                }
            }
        });

// ===== Email =====
        JLabel lblEmail = new JLabel("Email:");
        lblEmail.setBounds(10, 130, 100, 25);
        add(lblEmail);

        txtEmail.setBounds(10, 155, 380, 30);
        add(txtEmail);

// ===== Curso =====
        JLabel lblCurso = new JLabel("Curso:");
        lblCurso.setBounds(10, 190, 100, 25);
        add(lblCurso);

        txtCurso.setBounds(10, 215, 380, 30);
        add(txtCurso);

// ===== Apto =====
        chkApto.setBounds(10, 255, 200, 25);
        add(chkApto);

// ===== Botão =====
        btnSalvar.setBounds(10, 290, 120, 35);
        add(btnSalvar);

        btnSalvar.addActionListener(e -> salvar());

        setDefaultCloseOperation(EXIT_ON_CLOSE);
        setVisible(true);
    }

    private void salvar() {

        Aluno a = new Aluno();

        a.setNome(txtNome.getText());
        a.setEmail(txtEmail.getText());
        a.setMatricula(txtMatricula.getText());
        a.setCurso(txtCurso.getText());
        a.setApto(chkApto.isSelected());

        dao.inserir(a);

        JOptionPane.showMessageDialog(this, "Aluno salvo!");
    }
}