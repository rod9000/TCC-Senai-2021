using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using Gestão_de_gasto.Models;
using System.Data.Entity;


namespace Gestão_de_gasto.Models
{
    public class ViagensContext: DbContext
    {
        public DbSet<Viagens> Viagens { get; set; }

    }
}