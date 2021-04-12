using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using _SIGA_.MODELOS;
using System.Data;
using System.Configuration;
using _SIGA_.CONTROLE;
using System.Data.SqlClient;
using System.Threading.Tasks;


namespace _SIGA_.CONTROLE
{

    class crud
    {
        SqlConnection con = new SqlConnection(@"Data Source=(LocalDB)\MSSQLLocalDB;AttachDbFilename=C:\Users\vichc\source\repos\-SIGA-\-SIGA-\App_Data\dbssiga.mdf;Integrated Security=True");

 
        public void insirirusuario(string login, string senha, string nome, string funcao)
        {
            SqlConnection con = new SqlConnection(@"Data Source=(LocalDB)\MSSQLLocalDB;AttachDbFilename=C:\Users\vichc\source\repos\-SIGA-\-SIGA-\App_Data\dbssiga.mdf;Integrated Security=True");

            string adduser = "INSERT INTO USUARIO VALUES(@logu,@senu,@nomu, @funu);";
            SqlCommand cmd = new SqlCommand(adduser, con); 

            cmd.Parameters.AddWithValue("@logu", login);
            cmd.Parameters.AddWithValue("@senu", senha);
            cmd.Parameters.AddWithValue("@nomu", nome);
            cmd.Parameters.AddWithValue("@funu", funcao);

       
            con.Open();
            cmd.ExecuteNonQuery();
            con.Close();
        }
    }
}