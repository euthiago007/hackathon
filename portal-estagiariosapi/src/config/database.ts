import mysql from "mysql2/promise";
import dotenv from "dotenv";

dotenv.config();

export const pool = mysql.createPool({
  host: "localhost",
  user: "root",
  password: "",
  database: "portal-estagios",
  waitForConnections: true,
  connectionLimit: 10,
});