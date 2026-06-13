
package com.unialfa.util;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Conexao {

    private static final String URL = "jdbc:mysql://localhost:3306/portal-estagios";
    private static final String USER = "root";
    private static final String PASSWORD = "";

    public static Connection conectar() throws SQLException {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            System.out.println("Driver encontrado!");
        } catch (ClassNotFoundException e) {
            System.out.println("Driver NÃO encontrado!");
            e.printStackTrace();
        }

        System.out.println("Tentando conectar...");

        return DriverManager.getConnection(URL, USER, PASSWORD);
    }
}