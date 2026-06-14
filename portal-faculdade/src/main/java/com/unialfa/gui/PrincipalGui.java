package com.unialfa.gui;

import com.unialfa.service.RelatorioService;

import javax.swing.*;
import java.awt.*;

public class PrincipalGui extends JFrame {

    public PrincipalGui() {

        setTitle("Portal de Estágio - Sistema");
        setSize(900, 700);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLocationRelativeTo(null);

        criarMenu();
    }

    private void criarMenu() {

        JMenuBar menuBar = new JMenuBar();

        JMenu menuAlunos = new JMenu("Alunos");

        JMenuItem cadastrar = new JMenuItem("Cadastrar");
        JMenuItem consulta = new JMenuItem("Consulta");

        cadastrar.addActionListener(e ->
                new AlunoGUI().setVisible(true)
        );

        consulta.addActionListener(e ->
                new ListarAlunoGUI().setVisible(true)
        );

        menuAlunos.add(cadastrar);
        menuAlunos.add(consulta);

        JMenu menuGestao = new JMenu("Gestão");


        JMenuItem empresas = new JMenuItem("Empresas");
        JMenuItem vagas = new JMenuItem("Vagas");
        JMenuItem candidaturas = new JMenuItem("Candidaturas");

        empresas.addActionListener(e ->
                new EmpresaGui().setVisible(true)
        );

        vagas.addActionListener(e ->
                new VagaGui().setVisible(true)
        );

        candidaturas.addActionListener(e ->
                new CandidaturaGui().setVisible(true)
        );

        menuGestao.add(empresas);
        menuGestao.add(vagas);
        menuGestao.add(candidaturas);

        JMenu menuRelatorios = new JMenu("Relatórios");

        JMenuItem relAlunos = new JMenuItem("Alunos");
        JMenuItem relEmpresas = new JMenuItem("Empresas");
        JMenuItem relVagas = new JMenuItem("Vagas");
        JMenuItem relCandidaturas = new JMenuItem("Candidaturas");

        relAlunos.addActionListener(e ->
                new RelatorioService().relatorioAlunos()
        );

        relEmpresas.addActionListener(e ->
                new RelatorioService().relatorioEmpresas()
        );


        relVagas.addActionListener(e ->
                new RelatorioService().relatorioVagas()
        );

        relCandidaturas.addActionListener(e ->
                new RelatorioService().relatorioCandidaturas()
        );

        menuRelatorios.add(relAlunos);
        menuRelatorios.add(relEmpresas);
        menuRelatorios.add(relVagas);
        menuRelatorios.add(relCandidaturas);


        menuBar.add(menuAlunos);
        menuBar.add(menuGestao);
        menuBar.add(menuRelatorios);

        setJMenuBar(menuBar);
    }
}