package com.unialfa;

import com.unialfa.gui.AlunoGUI;

import javax.swing.SwingUtilities;

public class Main {
    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            new AlunoGUI();
        });
    }
}