using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using _SIGA_.CONTROLE;

namespace _SIGA_.PAGINAS
{
    public partial class seluser : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        
      
protected void gvuser_SelectedIndexChanged(object sender, EventArgs e)
        {
            Response.Write(gvuser.SelectedRow.Cells[1].Text);
        }

        protected void btnadd_Click(object sender, EventArgs e)
        {
            
                crud usuario = new crud();

                usuario.insirirusuario(txtlogin.Text, txtsenha.Text, txtnome.Text, txtfuncao.Text);
            Response.Redirect(Request.Url.AbsoluteUri);

        }

        protected void gvuser_RowDeleting(object sender, GridViewDeleteEventArgs e)
        {
           
        }

        protected void gvuser_RowDeleted(object sender, GridViewDeletedEventArgs e)
        {

        }

        protected void SqlDataSource1_Selecting(object sender, SqlDataSourceSelectingEventArgs e)
        {

        }
    }
}