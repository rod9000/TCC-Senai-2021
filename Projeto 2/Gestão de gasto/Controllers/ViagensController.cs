using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using Gestão_de_gasto.Models;

namespace Gestão_de_gasto.Controllers
{
    public class ViagensController : Controller
    {
        private ViagensContext db = new ViagensContext();

        // GET: Viagens
        public ActionResult Index()
        {
            return View(db.Viagens.ToList());
        }

        // GET: Viagens/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Viagens viagens = db.Viagens.Find(id);
            if (viagens == null)
            {
                return HttpNotFound();
            }
            return View(viagens);
        }

        // GET: Viagens/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: Viagens/Create
        // Para proteger-se contra ataques de excesso de postagem, ative as propriedades específicas às quais deseja se associar. 
        // Para obter mais detalhes, confira https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,dataDeSaida,dataDeReTorno,Destino,valorGasto,motivoViagem,realizada")] Viagens viagens)
        {
            if (ModelState.IsValid)
            {
                db.Viagens.Add(viagens);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(viagens);
        }

        // GET: Viagens/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Viagens viagens = db.Viagens.Find(id);
            if (viagens == null)
            {
                return HttpNotFound();
            }
            return View(viagens);
        }

        // POST: Viagens/Edit/5
        // Para proteger-se contra ataques de excesso de postagem, ative as propriedades específicas às quais deseja se associar. 
        // Para obter mais detalhes, confira https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,dataDeSaida,dataDeReTorno,Destino,valorGasto,motivoViagem,realizada")] Viagens viagens)
        {
            if (ModelState.IsValid)
            {
                db.Entry(viagens).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(viagens);
        }

        // GET: Viagens/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Viagens viagens = db.Viagens.Find(id);
            if (viagens == null)
            {
                return HttpNotFound();
            }
            return View(viagens);
        }

        // POST: Viagens/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Viagens viagens = db.Viagens.Find(id);
            db.Viagens.Remove(viagens);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
