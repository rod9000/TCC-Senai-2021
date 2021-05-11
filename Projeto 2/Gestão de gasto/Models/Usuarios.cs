using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace Gestão_de_gasto.Models
{
    public class Usuarios
    {
        [Key]
        public int Id { get; set; }
        [Display(Name = "Nome")]
        public string nome { get; set; }
        [Display(Name = "Sobrenome")]
        public string sobrenome { get; set; }
        [Display(Name = "E-mail")]
        public string email { get; set; }
        [Display(Name = "Senha")]
        public string senha { get; set; }
        [Display(Name = "Tipo")]
        public string tipo { get; set; }

    }
}


