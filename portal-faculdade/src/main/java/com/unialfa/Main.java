package com.unialfa;

import com.unialfa.gui.AlunoGUI;
import javax.swing.SwingUtilities;
import com.unialfa.gui.EmpresaGui;

import javax.swing.*;

public class Main {
    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            new AlunoGUI();
            new EmpresaGui().setVisible(true);
        });
    }
}