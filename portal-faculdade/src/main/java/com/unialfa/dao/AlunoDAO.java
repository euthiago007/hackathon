package com.unialfa.dao;

import com.unialfa.model.Aluno;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

public class AlunoDAO extends Dao {

    public void inserir(Aluno a) {

        String sql = "INSERT INTO alunos (nome, email, matricula, curso, apto_estagio) VALUES (?, ?, ?, ?, ?)";

        try {

            PreparedStatement stmt =
                    getConnection().prepareStatement(sql);

            stmt.setString(1, a.getNome());
            stmt.setString(2, a.getEmail());
            stmt.setString(3, a.getMatricula());
            stmt.setString(4, a.getCurso());
            stmt.setBoolean(5, a.isApto());

            stmt.executeUpdate();

            stmt.close();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public List<Aluno> listar() {

        List<Aluno> lista = new ArrayList<>();

        try {

            PreparedStatement stmt =
                    getConnection().prepareStatement("SELECT * FROM alunos");

            ResultSet rs = stmt.executeQuery();

            while (rs.next()) {

                Aluno a = new Aluno();

                a.setId(rs.getInt("id"));
                a.setNome(rs.getString("nome"));
                a.setEmail(rs.getString("email"));
                a.setMatricula(rs.getString("matricula"));
                a.setCurso(rs.getString("curso"));
                a.setApto(rs.getBoolean("apto_estagio"));

                lista.add(a);
            }

            rs.close();
            stmt.close();

        } catch (Exception e) {
            e.printStackTrace();
        }

        return lista;
    }
    public Aluno buscarPorId(int id) {

        try {

            PreparedStatement stmt =
                    getConnection().prepareStatement(
                            "SELECT * FROM alunos WHERE id = ?"
                    );

            stmt.setInt(1, id);

            ResultSet rs = stmt.executeQuery();

            if (rs.next()) {

                Aluno a = new Aluno();

                a.setId(rs.getInt("id"));
                a.setNome(rs.getString("nome"));
                a.setEmail(rs.getString("email"));
                a.setMatricula(rs.getString("matricula"));
                a.setCurso(rs.getString("curso"));
                a.setApto(rs.getBoolean("apto_estagio"));

                rs.close();
                stmt.close();

                return a;
            }

            rs.close();
            stmt.close();

        } catch (Exception e) {
            e.printStackTrace();
        }

        return null;
    }

    public void atualizar(Aluno a) {

        String sql =
                "UPDATE alunos SET nome=?, email=?, matricula=?, curso=?, apto_estagio=? WHERE id=?";

        try {

            PreparedStatement stmt =
                    getConnection().prepareStatement(sql);

            stmt.setString(1, a.getNome());
            stmt.setString(2, a.getEmail());
            stmt.setString(3, a.getMatricula());
            stmt.setString(4, a.getCurso());
            stmt.setBoolean(5, a.isApto());
            stmt.setInt(6, a.getId());

            stmt.executeUpdate();

            stmt.close();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

}
