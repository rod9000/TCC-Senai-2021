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
        public DateTime dataDeSaida { get; set; }
        public DateTime dataDeReTorno { get; set; }
        public string Destino { get; set; }
        public double valorGasto { get; set; }
        public string motivoViagem { get; set; }
        public int realizada { get; set; }
    }
}