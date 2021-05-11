using System;
using System.Collections.Generic;
using System.Linq;
using System.ComponentModel.DataAnnotations;
using System.Web;

namespace Gestão_de_gasto.Models
{
    public class Viagens
    {
        [Key]
        public int Id { get; set; }

        [Display(Name = "Data de Saida")]
        [DataType(DataType.Date)]
        public DateTime dataDeSaida { get; set; }

        [Display(Name = "Data de Retorno")]
        [DataType(DataType.Date)]
        public DateTime dataDeReTorno { get; set; }

        [Display(Name = "Destino")]
        public string Destino { get; set; }

        [Display(Name = "Valor Gasto")]
        [DataType(DataType.Currency)]
        public double valorGasto { get; set; }

        [Display(Name = "Motivo da Viagem")]
        [DataType(DataType.MultilineText)]
        public string motivoViagem { get; set; }

        [Display(Name = "Realizada")]
        //[DataType(DataType.)]
        public int realizada { get; set; }
    }
}
