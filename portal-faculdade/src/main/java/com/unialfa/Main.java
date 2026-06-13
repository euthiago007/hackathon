package com.unialfa;


import com.unialfa.gui.PrincipalGui;

import javax.swing.SwingUtilities;



public class Main {
    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {

            new PrincipalGui().setVisible(true);

        });
    }
}