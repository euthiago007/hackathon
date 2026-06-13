package com.unialfa;

import com.unialfa.gui.AlunoGUI;
import javax.swing.SwingUtilities;

import com.unialfa.gui.CandidaturaGui;
import com.unialfa.gui.EmpresaGui;
import com.unialfa.gui.VagaGui;

import javax.swing.*;

public class Main {
    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            new AlunoGUI();
            new EmpresaGui().setVisible(true);
            new VagaGui().setVisible(true);
            new CandidaturaGui().setVisible(true);
        });
    }
}