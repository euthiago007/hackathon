package com.unialfa.gui;

import javax.swing.*;
import com.unialfa.dao.AlunoDAO;
import com.unialfa.model.Aluno;

public class AlunoGUI extends JFrame{
    JTextField txtAlunoId = new JTextField();
    JTextField txtVagaId = new JTextField();
    JTextField txtStatus = new JTextField("data de emissão");
    JTextField txtCreatedAt = new JTextField();
    private JButton btnSalvar = new JButton("Salvar");

    private AlunoDAO dao = new AlunoDAO();

    public AlunoGUI() {

        setTitle("Cadastro de Aluno");
        setSize(300, 250);
        setLayout(null);

        JLabel lblAlunoId = new JLabel("Aluno ID:");
        lblAlunoId.setBounds(10, 10, 80, 25);
        add(lblAlunoId);

        txtAlunoId.setBounds(10, 35, 200, 25);
        add(txtAlunoId);

        JLabel lblVagaId = new JLabel("Vaga ID:");
        lblVagaId.setBounds(10, 65, 80, 25);
        add(lblVagaId);

        txtVagaId.setBounds(10, 90, 200, 25);
        add(txtVagaId);

        JLabel lblStatus = new JLabel("Status:");
        lblStatus.setBounds(10, 120, 80, 25);
        add(lblStatus);

        txtStatus.setBounds(10, 145, 200, 25);
        add(txtStatus);

        JLabel lblCreatedAt = new JLabel("Criado em:");
        lblCreatedAt.setBounds(10, 175, 80, 25);
        add(lblCreatedAt);

        txtCreatedAt.setBounds(10, 200, 200, 25);
        add(txtCreatedAt);

        btnSalvar.setBounds(10, 240, 100, 30);
        add(btnSalvar);

        btnSalvar.addActionListener(e -> salvar());

        setDefaultCloseOperation(EXIT_ON_CLOSE);
        setVisible(true);
    }

    private void salvar() {
        System.out.println("Botão clicado");

        Aluno a = new Aluno();
        a.setAlunoId(Integer.parseInt(txtAlunoId.getText()));
        a.setVagaId(Integer.parseInt(txtVagaId.getText()));
        a.setStatus(txtStatus.getText());

        dao.inserir(a);

        JOptionPane.showMessageDialog(this, "Aluno salvo!");
    }
}


