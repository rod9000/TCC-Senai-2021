using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.ComponentModel.DataAnnotations;

namespace Gestão_de_gasto.Models
{
    public class Despesas
    {
        [Key]
        public int Id { get; set; }

        [Display(Name = "Servico")]
        public string servico { get; set; }

        [Display(Name = "Valor")]
        public double valor { get; set; }

        [Display(Name = "Local")]
        public string local { get; set; }

        [Display(Name = "Data")]
        public DateTime data { get; set; }

        [Display(Name = "Forma de Pagamento")]
        public string formaDePagamento { get; set; }

        [Display(Name = "Viagem")]
        public string viagem { get; set; }


    }
}