using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(Gestão_de_gasto.Startup))]
namespace Gestão_de_gasto
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
