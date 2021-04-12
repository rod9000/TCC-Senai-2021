using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace _SIGA_.MODELOS
{
    public class Usuario
    {
        public Usuario() { }
        int idusuario { get; set; }
        string loginusuario { get; set; }
        string senhausuario { get; set; }
        string nomeusuario { get; set; }
        string funcaousuario { get; set; }

        public Usuario(int idusuario, string loginusuario, string senhausuario, string nomeusuario, string funcaousuario)
        {
            this.idusuario = idusuario;
            this.loginusuario = loginusuario;
            this.senhausuario = senhausuario;
            this.nomeusuario = nomeusuario;
            this.funcaousuario = funcaousuario;
        }


    }


}