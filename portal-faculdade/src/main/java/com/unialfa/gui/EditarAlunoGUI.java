package com.unialfa.gui;

import javax.swing.*;

import com.unialfa.dao.AlunoDAO;
import com.unialfa.model.Aluno;

public class EditarAlunoGUI extends JFrame {

    private JTextField txtNome = new JTextField();
    private JTextField txtEmail = new JTextField();
    private JTextField txtMatricula = new JTextField();
    private JTextField txtCurso = new JTextField();

    private AlunoDAO dao = new AlunoDAO();

    private JCheckBox chkApto =
            new JCheckBox("Apto para estágio");

    private JButton btnAtualizar =
            new JButton("Atualizar");

    private int idAluno;

    public EditarAlunoGUI(int idAluno) {

        this.idAluno = idAluno;

        setTitle("Editar Aluno");
        setSize(420, 420);
        setLayout(null);
        setLocationRelativeTo(null);

        JLabel lblNome = new JLabel("Nome:");
        lblNome.setBounds(10, 10, 100, 25);
        add(lblNome);

        txtNome.setBounds(10, 35, 380, 30);
        add(txtNome);

        JLabel lblEmail = new JLabel("Email:");
        lblEmail.setBounds(10, 75, 100, 25);
        add(lblEmail);

        txtEmail.setBounds(10, 100, 380, 30);
        add(txtEmail);

        JLabel lblMatricula =
                new JLabel("Matrícula (RA):");
        lblMatricula.setBounds(10, 140, 150, 25);
        add(lblMatricula);

        txtMatricula.setBounds(10, 165, 380, 30);
        add(txtMatricula);

        JLabel lblCurso = new JLabel("Curso:");
        lblCurso.setBounds(10, 205, 100, 25);
        add(lblCurso);

        txtCurso.setBounds(10, 230, 380, 30);
        add(txtCurso);

        chkApto.setBounds(10, 270, 200, 25);
        add(chkApto);

        btnAtualizar.setBounds(10, 310, 120, 35);
        add(btnAtualizar);

        btnAtualizar.addActionListener(e -> atualizar());

        carregarAluno();

        setVisible(true);
    }

    private void carregarAluno() {

        Aluno a = dao.buscarPorId(idAluno);

        if (a != null) {

            txtNome.setText(a.getNome());
            txtEmail.setText(a.getEmail());
            txtMatricula.setText(a.getMatricula());
            txtCurso.setText(a.getCurso());

            chkApto.setSelected(a.isApto());
        }
    }

    private void atualizar() {

        Aluno a = new Aluno();

        a.setId(idAluno);
        a.setNome(txtNome.getText());
        a.setEmail(txtEmail.getText());
        a.setMatricula(txtMatricula.getText());
        a.setCurso(txtCurso.getText());
        a.setApto(chkApto.isSelected());

        dao.atualizar(a);

        JOptionPane.showMessageDialog(this,
                "Aluno atualizado com sucesso!");

        dispose(); // fecha a janela
    }
}